<?php

namespace App\Markdown;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Event\DocumentRenderedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Renderer\Block\HtmlBlockRenderer;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Output\RenderedContent;
use League\CommonMark\Renderer\HtmlRenderer;
use function dump;
use function get_class;

class BladeRendererExtension implements ExtensionInterface
{

    public array $rendered = [];

    public Environment $environment;

    public function register(EnvironmentBuilderInterface $environment): void
    {

        $environment->addEventListener(
            DocumentParsedEvent::class, [$this, 'onDocumentParsed'], -10
        );

        $environment->addEventListener(
            DocumentRenderedEvent::class, [$this, 'onDocumentRendered'], 10
        );

        $this->environment = $environment;
    }


    public function onDocumentParsed(DocumentParsedEvent $event): void
    {

        foreach ($event->getDocument()->iterator() as $node) {
            if(!$this->isCodeNode($node)) {
                continue;
            }

            $id = Str::uuid()->toString();

            $replacement = new HtmlBlock(HtmlBlock::TYPE_6_BLOCK_ELEMENT);
            $replacement->setLiteral("[[replace:$id]]");

            $node->replaceWith($replacement);

            // Create an identical renderer to the main one
            $renderer = new HtmlRenderer($this->environment);
            // Render the code node and stash it away.
            $this->rendered[$id] = $renderer->renderNodes([$node]);

        }

        foreach ($event->getDocument()->iterator() as $node) {

            if (!$node instanceof HtmlBlock) {
                continue;
            }

            $literal = $node->getLiteral();
            if(!Str::startsWith($literal, '<x-highlight>')) {
               continue;
            }

            dump($node);
        }




    }

    public function onDocumentRendered(DocumentRenderedEvent $event)
    {
        $search = [];
        $replace = [];

        // Gather up all the placeholders and their real content
        foreach ($this->rendered as $id => $content) {
            $search[] = "[[replace:$id]]";
            $replace[] = $content;
        }

        // The HTML that Commonmark generated
        $content = $event->getOutput()->getContent();

        // First render the output without code blocks.

        $content = Blade::render($content);


        // Then add the code blocks back in.
        $content = Str::replace($search, $replace, $content);

        // And replace the entire response with our new, Blade-processed output.
        $event->replaceOutput(
            new RenderedContent($event->getOutput()->getDocument(), $content)
        );
    }

    protected function isCodeNode(Node $node): bool
    {
        return $node instanceof FencedCode
            || $node instanceof IndentedCode
            || $node instanceof Code;
    }
}

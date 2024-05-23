<?php

namespace App\Markdown;

use Illuminate\Support\Facades\Blade;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use Wordsphere\Ui\Components\Highlight\Base;
use function in_array;

class CodeRendererExtension implements ExtensionInterface, NodeRendererInterface
{

    public static bool $allowBladeForNextDocument = true;

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addRenderer(FencedCode::class, $this, 100);
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {

        if (!static::$allowBladeForNextDocument) {
            return;
        }

        /** @var $node FencedCode */
        $info = $node->getInfoWords();

        if (in_array('+parse', $info)) {
            return Blade::render('<x-highlight>'. $node->getLiteral() .'</x-highlight>');
        }

    }
}

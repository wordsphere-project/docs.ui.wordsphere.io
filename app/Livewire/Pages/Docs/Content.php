<?php

namespace App\Livewire\Pages\Docs;

use App\DataTransferObjects\ArticleFrontMatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use League\CommonMark\ConverterInterface;
use League\CommonMark\Exception\CommonMarkException;
use League\Config\Exception\ConfigurationExceptionInterface;
use Livewire\Attributes\Layout;
use Livewire\Component;
use function base_path;
use function dump;
use function file_get_contents;

#[Layout('layouts.docs')]
class Content extends Component
{

    public string $content = '';

    private ArticleFrontMatter $frontMatter;

    private ConverterInterface $converter;

    public function boot(ConverterInterface $converter)
    {
        $this->converter = $converter;
    }


    /**
     * @throws ConfigurationExceptionInterface
     * @throws CommonMarkException
     */
    public function mount(string $folder, string $slug): void
    {
        $content_path = base_path('content');
        $category_path = $content_path . '/' . $folder;
        $file_path = $category_path . '/' . $slug . '.md';

        $folderExists = File::isDirectory($category_path);
        $fileExists = File::isFile($file_path);

        $result = $this->converter->convert(file_get_contents($file_path));

        $this->content = $result->getContent();
        $this->frontMatter = ArticleFrontMatter::fromArray($result->getFrontMatter());

    }

    public function render(): View
    {
        return view('livewire.pages.docs.content')->with(
            'frontMatter', $this->frontMatter,
        );
    }
}

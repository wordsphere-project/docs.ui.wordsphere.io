<?php

namespace App\DataTransferObjects;

class ArticleFrontMatter
{

    public function __construct(
        public string $title,
        public string $excerpt,
        public string $github,
        public Author $author,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            excerpt: $data['excerpt'],
            github: $data['github'],
            author: Author::fromArray($data['author']),
        );
    }

}

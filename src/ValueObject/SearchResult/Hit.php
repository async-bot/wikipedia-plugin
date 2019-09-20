<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\ValueObject\SearchResult;

final class Hit
{
    private string $title;

    private string $excerpt;

    private string $url;

    public function __construct(string $title, string $excerpt, string $url)
    {
        $this->title   = $title;
        $this->excerpt = $excerpt;
        $this->url     = $url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}

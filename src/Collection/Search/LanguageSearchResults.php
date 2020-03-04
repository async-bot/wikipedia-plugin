<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\Collection\Search;

use AsyncBot\Plugin\Wikipedia\ValueObject\Search\LanguageSearchResult;

class LanguageSearchResults implements \Iterator, \Countable
{
    /**
     * @var array<LanguageSearchResult>
     */
    private array $results;

    public function __construct(LanguageSearchResult ...$results)
    {
        $this->results = $results;
    }

    public function getFirstResult(): ?LanguageSearchResult
    {
        if (!$this->results) {
            return null;
        }

        return $this->results[0];
    }

    public function current(): LanguageSearchResult
    {
        return current($this->results);
    }

    public function next(): void
    {
        next($this->results);
    }

    public function key(): ?int
    {
        return key($this->results);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }

    public function rewind(): void
    {
        reset($this->results);
    }

    public function count(): int
    {
        return count($this->results);
    }
}

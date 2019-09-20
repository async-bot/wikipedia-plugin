<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\ValueObject\SearchResult;

use function ExceptionalJSON\decode;

class Result
{
    private array $hits;

    public function __construct(Hit ...$hits)
    {
        $this->hits = $hits;
    }

    public static function fromJson(string $json): self
    {
        $result = decode($json, true);

        $hits = [];

        foreach ($result[1] as $index => $resultItem) {
            $hits = new Hit($resultItem, $result[2][$index], $result[3][$index]);
        }

        return new Result(...$hits);
    }

    public function getFirstHit(): ?Hit
    {
        if (!$this->hits) {
            return null;
        }

        return $this->hits[0];
    }
}

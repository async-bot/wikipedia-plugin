<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\Parser;

use AsyncBot\Plugin\Wikipedia\Collection\Search\OpenSearchResults;
use AsyncBot\Plugin\Wikipedia\ValueObject\Search\OpenSearchResult;

final class OpenSearchJson
{
    /**
     * @param array<string,mixed> $result
     */
    public function parse(array $result): OpenSearchResults
    {
        $results = [];

        foreach ($result[1] as $index => $resultItem) {
            $results[] = new OpenSearchResult($resultItem, $result[2][$index], $result[3][$index]);
        }

        return new OpenSearchResults(...$results);
    }
}

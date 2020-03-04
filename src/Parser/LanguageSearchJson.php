<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\Parser;

use AsyncBot\Plugin\Wikipedia\Collection\Search\LanguageSearchResults;
use AsyncBot\Plugin\Wikipedia\ValueObject\Search\LanguageSearchResult;

final class LanguageSearchJson
{
    /**
     * @param array<int,string|array<int,string>> $result
     */
    public function parse(array $result): LanguageSearchResults
    {
        $results = [];

        foreach ($result['languagesearch'] as $code => $name) {
            $results[] = new LanguageSearchResult($code, $name);
        }

        return new LanguageSearchResults(...$results);
    }
}

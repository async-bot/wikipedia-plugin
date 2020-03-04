<?php declare(strict_types=1);

namespace AsyncBot\Plugin\WikipediaTest\Unit\Collection\Search;

use AsyncBot\Plugin\Wikipedia\Collection\Search\LanguageSearchResults;
use AsyncBot\Plugin\Wikipedia\ValueObject\Search\LanguageSearchResult;
use PHPUnit\Framework\TestCase;

final class LanguageSearchResultsTest extends TestCase
{
    private LanguageSearchResults $searchResults;

    public function setUp(): void
    {
        $this->searchResults = new LanguageSearchResults(
            new LanguageSearchResult('wae', 'wae'),
            new LanguageSearchResult('vai', 'wai'),
            new LanguageSearchResult('wal', 'wal'),
            new LanguageSearchResult('war', 'war'),
        );
    }

    public function testGetFirstResultReturnsNullWhenThereAreNoResults(): void
    {
        $searchResults = new LanguageSearchResults();

        $this->assertNull($searchResults->getFirstResult());
    }

    public function testGetFirstResultReturnsResult(): void
    {
        $result = $this->searchResults->getFirstResult();

        $this->assertInstanceOf(LanguageSearchResult::class, $result);
        $this->assertSame('wae', $result->getCode());
    }

    public function testIterator(): void
    {
        $expected = [
            'wae',
            'vai',
            'wal',
            'war',
        ];

        foreach ($this->searchResults as $index => $searchResult) {
            $this->assertSame($expected[$index], $searchResult->getCode());
        }
    }

    public function testCount(): void
    {
        $this->assertCount(4, $this->searchResults);
    }
}

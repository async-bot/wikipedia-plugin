<?php declare(strict_types=1);

namespace AsyncBot\Plugin\WikipediaTest\Unit\Collection\Search;

use AsyncBot\Plugin\Wikipedia\Collection\Search\OpenSearchResults;
use AsyncBot\Plugin\Wikipedia\ValueObject\Search\OpenSearchResult;
use PHPUnit\Framework\TestCase;

final class OpenSearchResultsTest extends TestCase
{
    private OpenSearchResults $searchResults;

    public function setUp(): void
    {
        $this->searchResults = new OpenSearchResults(
            new OpenSearchResult('Rasmus Lerdorf', '', 'https://en.wikipedia.org/wiki/Rasmus_Lerdorf'),
            new OpenSearchResult('Gonzo journalism', '', 'https://en.wikipedia.org/wiki/Gonzo_journalism'),
            new OpenSearchResult('PHP', '', 'https://en.wikipedia.org/wiki/PHP'),
        );
    }

    public function testGetFirstResultReturnsNullWhenThereAreNoResults(): void
    {
        $searchResults = new OpenSearchResults();

        $this->assertNull($searchResults->getFirstResult());
    }

    public function testGetFirstResultReturnsResult(): void
    {
        $result = $this->searchResults->getFirstResult();

        $this->assertInstanceOf(OpenSearchResult::class, $result);
        $this->assertSame('Rasmus Lerdorf', $result->getTitle());
    }

    public function testIterator(): void
    {
        $expected = [
            'Rasmus Lerdorf',
            'Gonzo journalism',
            'PHP',
        ];

        foreach ($this->searchResults as $index => $searchResult) {
            $this->assertSame($expected[$index], $searchResult->getTitle());
        }
    }

    public function testCount(): void
    {
        $this->assertCount(3, $this->searchResults);
    }
}

<?php declare(strict_types=1);

namespace AsyncBot\Plugin\WikipediaTest\Unit\ValueObject\Search;

use AsyncBot\Plugin\Wikipedia\ValueObject\Search\OpenSearchResult;
use PHPUnit\Framework\TestCase;

final class OpenSearchResultTest extends TestCase
{
    private OpenSearchResult $result;

    public function setUp(): void
    {
        $this->result = new OpenSearchResult(
            'Rasmus Lerdorf',
            '',
            'https://en.wikipedia.org/wiki/Rasmus_Lerdorf',
        );
    }

    public function testGetTitle(): void
    {
        $this->assertSame('Rasmus Lerdorf', $this->result->getTitle());
    }

    public function testGetExcerpt(): void
    {
        $this->assertSame('', $this->result->getExcerpt());
    }

    public function testGetUrl(): void
    {
        $this->assertSame('https://en.wikipedia.org/wiki/Rasmus_Lerdorf', $this->result->getUrl());
    }
}

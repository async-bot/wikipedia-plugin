<?php declare(strict_types=1);

namespace AsyncBot\Plugin\WikipediaTest\Unit\ValueObject\Search;

use AsyncBot\Plugin\Wikipedia\ValueObject\Search\LanguageSearchResult;
use PHPUnit\Framework\TestCase;

final class LanguageSearchResultTest extends TestCase
{
    private LanguageSearchResult $result;

    public function setUp(): void
    {
        $this->result = new LanguageSearchResult('nl', 'nl – dutch');
    }

    public function testGetCode(): void
    {
        $this->assertSame('nl', $this->result->getCode());
    }

    public function testGetName(): void
    {
        $this->assertSame('nl – dutch', $this->result->getName());
    }
}

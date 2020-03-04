<?php declare(strict_types=1);

namespace AsyncBot\Plugin\WikipediaTest\Unit\Parser;

use AsyncBot\Plugin\Wikipedia\Parser\OpenSearchJson;
use PHPUnit\Framework\TestCase;

final class OpenSearchJsonTest extends TestCase
{
    private OpenSearchJson $parser;

    /** @var array<int,string|array<int,string>> */
    private array $jsonData;

    public function setUp(): void
    {
        $this->parser = new OpenSearchJson();

        $this->jsonData = [
            'x-com al',
            [
                'X-COM: Alliance',
                'X-COM: Apocalypse',
                'XCom Global',
                'Xomali (Xochimilco Light Rail)',
            ],
            [
                '',
                '',
                '',
                '',
            ],
            [
                'https://en.wikipedia.org/wiki/X-COM:_Alliance',
                'https://en.wikipedia.org/wiki/X-COM:_Apocalypse',
                'https://en.wikipedia.org/wiki/XCom_Global',
                'https://en.wikipedia.org/wiki/Xomali_(Xochimilco_Light_Rail)',
            ],
        ];
    }

    public function testParseParsesEmptyResult(): void
    {
        $results = $this->parser->parse([
            'some unknown topic',
            [],
            [],
            [],
        ]);

        $this->assertCount(0, $results);
    }

    public function testParseParsesAllResults(): void
    {
        $results = $this->parser->parse($this->jsonData);

        $this->assertCount(4, $results);
    }

    public function testParseParsesCorrectData(): void
    {
        $results = $this->parser->parse($this->jsonData);

        $this->assertSame('X-COM: Alliance', $results->getFirstResult()->getTitle());
        $this->assertSame('', $results->getFirstResult()->getExcerpt());
        $this->assertSame('https://en.wikipedia.org/wiki/X-COM:_Alliance', $results->getFirstResult()->getUrl());
    }
}

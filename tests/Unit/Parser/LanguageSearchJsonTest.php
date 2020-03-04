<?php declare(strict_types=1);

namespace AsyncBot\Plugin\WikipediaTest\Unit\Parser;

use AsyncBot\Plugin\Wikipedia\Parser\LanguageSearchJson;
use PHPUnit\Framework\TestCase;

final class LanguageSearchJsonTest extends TestCase
{
    private LanguageSearchJson $parser;

    /** @var array<int,string|array<int,string>> */
    private array $jsonData;

    public function setUp(): void
    {
        $this->parser = new LanguageSearchJson();

        $this->jsonData = [
            'languagesearch' => [
                'vai' => 'wai',
                'wae' => 'wae',
                'wal' => 'wal',
                'war' => 'war',
            ],
        ];
    }

    public function testParseParsesEmptyResult(): void
    {
        $results = $this->parser->parse([
            'languagesearch' => [],
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

        $this->assertSame('vai', $results->getFirstResult()->getCode());
        $this->assertSame('wai', $results->getFirstResult()->getName());
    }
}

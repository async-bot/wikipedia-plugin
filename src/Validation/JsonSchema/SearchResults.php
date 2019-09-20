<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\Validation\JsonSchema;

use Opis\JsonSchema\Schema;
use Opis\JsonSchema\Validator;
use function ExceptionalJSON\decode;
use function ExceptionalJSON\encode;

final class SearchResults
{
    private string $schema;

    public function __construct()
    {
        $this->schema = encode([
            '$id'     => 'AsyncBot/Plugin/Wikipedia/search-results.json',
            '$schema' => 'http://json-schema.org/draft-07/schema#',
            'title'   => 'Wikipedia search results',
            'type'    => 'array',
            'items'   => [
                [
                    'type' => 'string',
                ],
                [
                    'type' => 'array',
                ],
                [
                    'type' => 'array',
                ],
                [
                    'type' => 'array',
                ]
            ],
        ]);
    }

    public function validateJson(string $json): bool
    {
        $schema = Schema::fromJsonString($this->schema);

        return (new Validator())->schemaValidation(decode($json), $schema)->isValid();
    }
}

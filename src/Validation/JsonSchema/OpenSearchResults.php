<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\Validation\JsonSchema;

use AsyncBot\Core\Http\Validation\JsonSchema;

final class OpenSearchResults extends JsonSchema
{
    public function __construct()
    {
        parent::__construct([
            '$id'     => 'AsyncBot/Plugin/Wikipedia/open-search-results.json',
            '$schema' => 'http://json-schema.org/draft-07/schema#',
            'title'   => 'Wikipedia API:Opensearch results',
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
                ],
            ],
        ]);
    }
}

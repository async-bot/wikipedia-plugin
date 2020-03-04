<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\Validation\JsonSchema;

use AsyncBot\Core\Http\Validation\JsonSchema;

final class LanguageSearchResults extends JsonSchema
{
    public function __construct()
    {
        parent::__construct([
            '$id'        => 'AsyncBot/Plugin/Wikipedia/language-search-results.json',
            '$schema'    => 'http://json-schema.org/draft-07/schema#',
            'title'      => 'Wikipedia API:Languagesearch results',
            'type'       => 'object',
            'required'   => 'languagesearch',
            'properties' => [
                'languagesearch' => [
                    'type' => ['array', 'object'],
                ],
            ],
        ]);
    }
}

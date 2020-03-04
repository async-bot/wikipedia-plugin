<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\Wikipedia\Collection\Search\OpenSearchResults as OpenSearchResultsCollection;
use AsyncBot\Plugin\Wikipedia\Parser\OpenSearchJson;
use AsyncBot\Plugin\Wikipedia\Validation\JsonSchema\OpenSearchResults;
use function Amp\call;

final class Plugin
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @url: https://www.mediawiki.org/wiki/API:Opensearch
     * @return Promise<OpenSearchResultsCollection>
     */
    public function openSearch(string $keywords): Promise
    {
        return call(function () use ($keywords) {
            $url = sprintf(
                'https://en.wikipedia.org/w/api.php?origin=*&action=opensearch&search=%s',
                urlencode($keywords),
            );

            $response = yield $this->httpClient->requestJson($url, new OpenSearchResults());

            return (new OpenSearchJson())->parse($response);
        });
    }
}

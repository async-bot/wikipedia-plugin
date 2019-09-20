<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia;

use Amp\Http\Client\Client;
use Amp\Http\Client\HttpException;
use Amp\Http\Client\Request;
use Amp\Http\Client\Response;
use Amp\Promise;
use AsyncBot\Plugin\Wikipedia\Exception\NetworkError;
use AsyncBot\Plugin\Wikipedia\Exception\UnexpectedJsonFormat;
use AsyncBot\Plugin\Wikipedia\Validation\JsonSchema\SearchResults;
use AsyncBot\Plugin\Wikipedia\ValueObject\SearchResult\Result;
use function Amp\call;

final class Plugin
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Promise<string|null>
     */
    public function getDefinition(string ...$keywords): Promise
    {
        return call(function () use ($keywords) {
            /** @var Result $searchResults */
            $searchResults = yield $this->search(...$keywords);

            if (($hit = $searchResults->getFirstHit()) === null) {
                return null;
            }

            return $hit->getExcerpt();
        });
    }

    /**
     * @return Promise<string|null>
     */
    public function getUrl(string ...$keywords): Promise
    {
        return call(function () use ($keywords) {
            /** @var Result $searchResults */
            $searchResults = yield $this->search(...$keywords);

            if (($hit = $searchResults->getFirstHit()) === null) {
                return null;
            }

            return $hit->getUrl();
        });
    }

    /**
     * @return Promise<Result>
     */
    private function search(string ...$keywords): Promise
    {
        return call(function () use ($keywords) {
            $request = new Request(sprintf(
                'https://en.wikipedia.org/w/api.php?origin=*&action=opensearch&search=%s',
                urlencode(implode(' ', $keywords)),
            ));

            try {
                /** @var Response $response */
                $response = yield $this->httpClient->request($request);
            } catch(HttpException $e) {
                throw new NetworkError($request, 0, $e);
            }

            if ($response->getStatus() !== 200) {
                throw new NetworkError($request, $response->getStatus());
            }

            $json = yield $response->getBody()->buffer();

            if (!(new SearchResults())->validateJson($json)) {
                throw new UnexpectedJsonFormat();
            }

            return Result::fromJson(yield $response->getBody()->buffer());
        });
    }
}

<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\Test;

use Amp\Http\Client\Client;
use AsyncBot\Plugin\Wikipedia\Plugin;
use function Amp\Promise\wait;

require_once __DIR__ . '/../vendor/autoload.php';

$plugin = new Plugin(new Client());

wait($plugin->getDefinition('rasmus', 'lerdorf'));

wait($plugin->getUrl('rasmus', 'lerdorf'));

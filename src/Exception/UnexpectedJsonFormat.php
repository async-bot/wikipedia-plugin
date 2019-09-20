<?php declare(strict_types=1);

namespace AsyncBot\Plugin\Wikipedia\Exception;

final class UnexpectedJsonFormat extends Exception
{
    public function __construct()
    {
        parent::__construct('The response is not in the expected JSON format');
    }
}

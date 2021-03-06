<?php

namespace Dykyi\Client\DataExtractor;

use Dykyi\Client\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseDataExtractor
 * @package Dykyi
 */
final class ResponseDataExtractor implements ResponseDataInterface
{
    /**
     * @param ResponseInterface $response
     *
     * @return mixed
     */
    public function extract(ResponseInterface $response)
    {
        $responseBody = $response->getBody()->getContents();
        $responseBody = rtrim($responseBody);
        $rawDecoded = json_decode($responseBody);
        if ($rawDecoded === null) {
            $oneLineResponseBody = str_replace("\n", '\n', $responseBody);
            throw new ClientException(sprintf("Can't decode response: %s", $oneLineResponseBody));
        }
        return $rawDecoded;
    }
}

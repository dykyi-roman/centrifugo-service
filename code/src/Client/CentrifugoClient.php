<?php

namespace Dykyi\Client;

use Dykyi\Client\DataExtractor\ResponseDataExtractor;
use Dykyi\Client\Response\ResponseException;
use Dykyi\Client\Response\ResponseInterface;
use Dykyi\Client\Response\ResponseResult;

/**
 * Class CentrifugoClient
 */
final class CentrifugoClient implements CentrifugoInterface
{
    /**
     * Variable
     *
     * @var GuzzleClient |
     */
    private $client;

    /**
     * CentrifugoClient constructor.
     *
     * @param string $host
     * @param string $apiKey
     */
    public function __construct(string $host, string $apiKey = '')
    {
        $this->client = new GuzzleClient($host, $apiKey, new ResponseDataExtractor());
    }

    /**
     * @inheritdoc
     */
    public function publish(string $channel, array $data = []): ResponseInterface
    {
        return $this->buildRequest('publish', ['channel' => $channel, 'data' => $data,]);
    }

    /**
     * @inheritdoc
     */
    public function broadcast(array $channels, array $data): ResponseInterface
    {
        return $this->buildRequest('broadcast', ['channels' => $channels, 'data' => $data,]);
    }

    /**
     * @inheritdoc
     */
    public function presence(string $channel): ResponseInterface
    {
        return $this->buildRequest('presence', ['channel' => $channel]);
    }

    /**
     * @inheritdoc
     */
    public function presenceStats(string $channel): ResponseInterface
    {
        return $this->buildRequest('presence_stats', ['channel' => $channel]);
    }

    /**
     * @inheritdoc
     */
    public function history(string $channel): ResponseInterface
    {
        return $this->buildRequest('history', ['channel' => $channel]);
    }

    /**
     * @inheritdoc
     */
    public function historyRemove(string $channel): ResponseInterface
    {
        return $this->buildRequest('unsubscribe', ['channel' => $channel]);
    }

    /**
     * @inheritdoc
     */
    public function unsubscribe(string $channel, int $userId): ResponseInterface
    {
        return $this->buildRequest('unsubscribe', ['channel' => $channel, 'user' => $userId,]);
    }

    /**
     * @inheritdoc
     */
    public function disconnect(int $userId): ResponseInterface
    {
        return $this->buildRequest('disconnect', ['user' => $userId]);
    }

    /**
     * @inheritdoc
     */
    public function channels(): ResponseInterface
    {
        return $this->buildRequest('channels');
    }

    /**
     * @inheritdoc
     */
    public function info(): ResponseInterface
    {
        return $this->buildRequest('info');
    }

    /**
     * @param string $method
     * @param array  $params
     * @param string $uri
     *
     * @return ResponseInterface
     */
    private function buildRequest(string $method, array $params = [], $uri = '/api'): ResponseInterface
    {
        $response = $this->client->post([
            'method' => $method,
            'params' => $params,
        ], $uri);

        if (isset($response->error)) {
            return new ResponseException($response->error);
        }

        if (isset($response->result)) {
            return new ResponseResult($response->result);
        }

        return new ResponseResult(new \stdClass());
    }
}

<?php

namespace Dykyi\Client;

use Dykyi\Client\DataExtractor\ResponseDataExtractor;

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
     * Variable
     *
     * @var string |
     */
    private $secret;

    /**
     * CentrifugoClient constructor.
     *
     * @param string $host
     * @param string $secret
     */
    public function __construct(string $host, string $secret)
    {
        $this->secret = $secret;
        $this->client = new GuzzleClient($host, new ResponseDataExtractor());
    }

    /**
     * @param string $channel
     * @param array  $data
     *
     * @return object
     */
    public function publish(string $channel, array $data = []): object
    {
        return $this->client->post([
            'method' => 'publish',
            'params' => [
                'channel' => $channel,
                'data' => $data,
            ],
        ], '/api');
    }

}

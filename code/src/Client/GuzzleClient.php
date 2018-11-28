<?php

namespace Dykyi\Client;

use Dykyi\Client\DataExtractor\ResponseDataExtractor;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class GuzzleClient
 * @package Dykyi
 */
final class GuzzleClient
{
    /**
     * Variable
     *
     * @var ClientInterface |
     */
    private $client;
    /**
     * Variable
     *
     * @var ResponseDataExtractor |
     */
    private $extractor;
    /**
     * Variable
     *
     * @var LoggerInterface |
     */
    private $logger;

    /**
     * GuzzleClient constructor.
     *
     * @param string                $host
     * @param ResponseDataExtractor $extractor
     * @param LoggerInterface|null  $logger
     */
    public function __construct(string $host, ResponseDataExtractor $extractor, LoggerInterface $logger = null)
    {
        $this->client = new Client([
            'base_uri' => $host,
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $this->extractor = $extractor;

        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * @param array  $data
     * @param string $uri
     *
     * @return object
     */
    public function post(array $data, string $uri = ''): object
    {
        $response = $this->send(new Request('POST', $uri, [], json_encode($data)));
        return $this->extractor->extract($response);
    }

    /**
     * @param string $uri
     *
     * @return object
     */
    public function get(string $uri = ''): object
    {
        $response = $this->send(new Request('GET', $uri));
        return $this->extractor->extract($response);
    }


    /**
     * @param RequestInterface $request
     * @param array            $options
     *
     * @return ResponseInterface
     */
    private function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        $this->logger->info(sprintf('%s "%s"', $request->getMethod(), $request->getUri()));
        try {
            return $this->client->send($request, $options);
        } catch (GuzzleException $e) {
            return new Response();
        }
    }
}

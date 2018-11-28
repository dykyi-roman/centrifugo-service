<?php

namespace Dykyi\Client;

/**
 * Interface CentrifugoInterface
 * @package Dykyi
 */
interface CentrifugoInterface
{
    /**
     * @param string $channel
     * @param array  $data
     *
     * @return object
     */
    public function publish(string $channel, array $data = []): object;
}

<?php

namespace Probots\Pinecone;

use Probots\Pinecone\Resources\Data;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Client implements LoggerAwareInterface
{
    use HandlesGuzzle;

    /**
     * @param string $apiKey
     * @param string $baseUrl
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        protected string $apiKey,
        protected string $baseUrl,
        protected ?LoggerInterface $logger = null,
    ) {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Api-Key' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'timeout' => 180,
            'connect_timeout' => 180,
            'proxy' => ''
        ]);

        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * @param string $apiKey
     * @param string $environment
     * @param LoggerInterface|null $logger
     * @return static
     */
    public static function from(string $apiKey, string $environment, ?LoggerInterface $logger = null): static
    {
        return new static($apiKey, $environment, $logger);
    }

    /**
     * @param LoggerInterface $logger
     * @return void
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @return Data
     */
    public function data(): Data
    {
        return new Data($this);
    }
}
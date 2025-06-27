<?php

namespace Probots\Pinecone;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class Client extends Connector
{
    /**
     * @param string $apiKey
     * @param string $environment
     * @param string $projectId
     */
    public function __construct(
        protected string $apiKey,
        protected string $environment,
        protected string $projectId
    ) {
        //
    }

    /**
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return "https://controller.{$this->environment}.pinecone.io";
    }

    /**
     * @return array
     */
    protected function defaultHeaders(): array
    {
        return [
            'Api-Key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * This method contains your custom timeout settings.
     * @return array
     */
    protected function defaultConfig(): array
    {
        return [
            'timeout' => 180,
            'connect_timeout' => 180,
        ];
    }

    /**
     * @return Data
     */
    public function data(): Data
    {
        return new Data($this);
    }
}
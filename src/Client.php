<?php

namespace Probots\Pinecone;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class Client extends Connector
{
    use AcceptsJson;

    /**
     * @param string $apiKey
     * @param string $environment
     * @param string|null $projectId
     */
    public function __construct(
        protected string $apiKey,
        protected string $environment,
        protected ?string $projectId = null
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
        ];
    }

    /**
     * This is your required customization for timeouts.
     * @return array
     */
    protected function defaultConfig(): array
    {
        return [
            'timeout' => 180,
            'connect_timeout' => 180,
        ];
    }
}
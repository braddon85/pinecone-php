<?php

namespace Probots\Pinecone\Requests\Data;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListVectors extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?string $namespace = null,
        protected ?int $limit = null,
        protected ?string $paginationToken = null,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/vectors/list';
    }

    protected function defaultQuery(): array
    {
        $query = [
            'namespace' => $this->namespace,
            'limit' => $this->limit,
        ];

        if ($this->paginationToken) {
            $query['paginationToken'] = $this->paginationToken;
        }

        return array_filter($query);
    }
}
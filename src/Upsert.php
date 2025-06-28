<?php

namespace Probots\Pinecone\Requests\Vectors;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class Upsert extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $vectors,
        protected string $namespace = ''
    ) {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/vectors/upsert';
    }

    protected function defaultBody(): array
    {
        $body = ['vectors' => $this->vectors];

        if ($this->namespace) {
            $body['namespace'] = $this->namespace;
        }

        return $body;
    }
}
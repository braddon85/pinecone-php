<?php

namespace Probots\Pinecone\Resources;

use Probots\Pinecone\Requests\Vectors\Upsert;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Vectors extends BaseResource
{
    public function upsert(array $vectors, string $namespace = ''): Response
    {
        return $this->connector->send(new Upsert($vectors, $namespace));
    }
}
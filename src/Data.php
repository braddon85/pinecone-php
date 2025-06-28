<?php

namespace Probots\Pinecone;

use Saloon\Http\BaseResource;

class Data extends BaseResource
{
    public function vectors(): Resources\Vectors
    {
        return new Resources\Vectors($this->connector);
    }
}
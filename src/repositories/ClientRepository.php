<?php

namespace yunwuxin\oauth\server\repositories;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use yunwuxin\oauth\server\interfaces\ClientInterface;

class ClientRepository implements ClientRepositoryInterface
{

    /**
     * @param ClientInterface $repository
     */
    public function __construct(protected $repository)
    {
    }

    public function getClientEntity($id)
    {
        ($this->repository)::get($id);
    }

    public function validateClient($id, $secret, $grantType)
    {
        return ($this->repository)::validate($id, $secret, $grantType);
    }
}

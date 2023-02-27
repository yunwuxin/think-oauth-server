<?php

namespace yunwuxin\oauth\server\repositories;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use yunwuxin\oauth\server\entities\Scope;

class ScopeRepository implements ScopeRepositoryInterface
{
    /**
     * @param \yunwuxin\oauth\server\interfaces\ScopeInterface $repository
     */
    public function __construct(protected $repository = null)
    {

    }

    public function getScopeEntityByIdentifier($identifier)
    {
        if ($this->repository) {
            return ($this->repository)::get($identifier);
        }
        return new Scope($identifier);
    }

    /**
     * @param array $scopes
     * @param string $grantType
     * @param ClientEntityInterface $client
     * @param null $userIdentifier
     * @return array
     */
    public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $client, $userIdentifier = null)
    {
        if ($this->repository) {
            return ($this->repository)::finalize($scopes, $grantType, $client, $userIdentifier);
        }
        return $scopes;
    }
}

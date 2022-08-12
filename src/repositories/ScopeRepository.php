<?php

namespace yunwuxin\oauth\server\repositories;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use yunwuxin\oauth\server\entities\Scope;

class ScopeRepository implements ScopeRepositoryInterface
{

    public function getScopeEntityByIdentifier($identifier)
    {
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
        if ($grantType == 'client_credentials') {
            return array_merge($scopes, array_map([$this, 'getScopeEntityByIdentifier'], $client->getScopes()));
        }
        return $scopes;
    }
}

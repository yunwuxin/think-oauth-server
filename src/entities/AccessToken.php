<?php

namespace yunwuxin\oauth\server\entities;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

class AccessToken implements AccessTokenEntityInterface
{
    use AccessTokenTrait, EntityTrait, TokenEntityTrait;

    public function __construct(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        $this->setClient($clientEntity);

        foreach ($scopes as $scope) {
            $this->addScope($scope);
        }

        $this->setUserIdentifier($userIdentifier);
    }
}

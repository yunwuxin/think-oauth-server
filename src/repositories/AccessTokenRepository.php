<?php

namespace yunwuxin\oauth\server\repositories;

use yunwuxin\oauth\server\entities\AccessToken;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use yunwuxin\oauth\server\interfaces\AccessTokenInterface;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{

    /**
     * @param AccessTokenInterface $repository
     */
    public function __construct(protected $repository)
    {
    }

    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        return new AccessToken($clientEntity, $scopes, $userIdentifier);
    }

    public function persistNewAccessToken($accessTokenEntity)
    {
        ($this->repository)::persist($accessTokenEntity);
    }

    public function revokeAccessToken($tokenId)
    {
        ($this->repository)::revoke($tokenId);
    }

    public function isAccessTokenRevoked($tokenId)
    {
        return ($this->repository)::isRevoked($tokenId);
    }
}

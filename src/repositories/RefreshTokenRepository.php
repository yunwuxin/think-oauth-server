<?php

namespace yunwuxin\oauth\server\repositories;

use yunwuxin\oauth\server\entities\RefreshToken;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{

    public function getNewRefreshToken()
    {
        return new RefreshToken();
    }

    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {

    }

    public function revokeRefreshToken($tokenId)
    {

    }

    public function isRefreshTokenRevoked($tokenId)
    {
        return true;
    }
}

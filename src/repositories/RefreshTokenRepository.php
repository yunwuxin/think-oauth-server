<?php

namespace yunwuxin\oauth\server\repositories;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use yunwuxin\oauth\server\entities\RefreshToken;
use yunwuxin\oauth\server\interfaces\RefreshTokenInterface;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    /**
     * @param RefreshTokenInterface $repository
     */
    public function __construct(protected $repository = null)
    {
    }

    public function getNewRefreshToken()
    {
        return new RefreshToken();
    }

    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        if ($this->repository) {
            ($this->repository)::persist($refreshTokenEntity);
        }
    }

    public function revokeRefreshToken($tokenId)
    {
        if ($this->repository) {
            ($this->repository)::revoke($tokenId);
        }
    }

    public function isRefreshTokenRevoked($tokenId)
    {
        if ($this->repository) {
            return ($this->repository)::isRevoked($tokenId);
        }
        return true;
    }
}

<?php

namespace yunwuxin\oauth\server\interfaces;

use yunwuxin\oauth\server\entities\RefreshToken;

interface RefreshTokenInterface
{
    public static function persist(RefreshToken $refreshToken);

    public static function revoke($id);

    public static function isRevoked($id): bool;
}

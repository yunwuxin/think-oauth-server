<?php

namespace yunwuxin\oauth\server\interfaces;

use yunwuxin\oauth\server\entities\AccessToken;

interface AccessTokenInterface
{
    public static function persist(AccessToken $accessToken);

    public static function revoke($id);

    public static function isRevoked($id): bool;
}

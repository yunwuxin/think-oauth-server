<?php

namespace yunwuxin\oauth\server\interfaces;

use yunwuxin\oauth\server\entities\Client;

interface ClientInterface
{
    public static function get($id): ?Client;

    public static function validate($identifier, $secret, $grantType): bool;
}

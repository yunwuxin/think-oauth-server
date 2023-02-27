<?php

namespace yunwuxin\oauth\server\interfaces;

use yunwuxin\oauth\server\entities\Client;
use yunwuxin\oauth\server\entities\Scope;

interface ScopeInterface
{
    public static function get($id): ?Scope;

    public static function finalize(array $scopes, $grantType, Client $client, $userIdentifier = null): array;
}

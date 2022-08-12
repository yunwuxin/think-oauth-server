<?php

namespace yunwuxin\oauth\server\repositories;

use yunwuxin\oauth\server\entities\AuthCode;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use think\Cache;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{

    public function __construct(protected Cache $cache)
    {
    }

    public function getNewAuthCode()
    {
        return new AuthCode();
    }

    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {
        $this->cache->set("oauth_code_{$authCodeEntity->getIdentifier()}", true, $authCodeEntity->getExpiryDateTime());
    }

    public function revokeAuthCode($codeId)
    {
        $this->cache->delete("oauth_code_{$codeId}");
    }

    public function isAuthCodeRevoked($codeId)
    {
        return !$this->cache->has("oauth_code_{$codeId}");
    }
}

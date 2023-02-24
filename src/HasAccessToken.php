<?php

namespace yunwuxin\oauth\server;

use yunwuxin\oauth\server\entities\AccessToken;

trait HasAccessToken
{
    /** @var AccessToken|null */
    protected $accessToken;

    /**
     * @param AccessToken $token
     */
    public function setAccessToken($token): void
    {
        $this->accessToken = $token;
    }

    /**
     * @return AccessToken|null
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}

<?php

namespace yunwuxin\oauth\server;

use GuzzleHttp\Psr7\ServerRequest;

class Request extends ServerRequest
{
    public function getClientId()
    {
        return $this->getAttribute('oauth_client_id');
    }

    public function getAccessTokenId()
    {
        return $this->getAttribute('oauth_access_token_id');
    }

    public function getUserId()
    {
        return $this->getAttribute('oauth_user_id');
    }

    public function getScopes()
    {
        return $this->getAttribute('oauth_scopes');
    }
}

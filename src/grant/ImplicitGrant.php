<?php

namespace yunwuxin\oauth\server\grant;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\RequestEvent;
use Psr\Http\Message\ServerRequestInterface;
use think\helper\Str;

class ImplicitGrant extends \League\OAuth2\Server\Grant\ImplicitGrant
{
    protected function validateRedirectUri(
        string                 $redirectUri,
        ClientEntityInterface  $client,
        ServerRequestInterface $request
    )
    {
        foreach ((array) $client->getRedirectUri() as $allowedRedirectUri) {
            if (Str::startsWith($redirectUri, $allowedRedirectUri)) {
                return;
            }
        }

        $this->getEmitter()->emit(new RequestEvent(RequestEvent::CLIENT_AUTHENTICATION_FAILED, $request));
        throw OAuthServerException::invalidClient($request);
    }
}

<?php

namespace yunwuxin\oauth\server;

use League\OAuth2\Server\Exception\OAuthServerException;
use think\Config;
use think\Request;
use yunwuxin\oauth\server\repositories\AccessTokenRepository;

class ResourceServer
{
    protected $server;

    public function __construct(Config $config)
    {
        $accessTokenRepository = new AccessTokenRepository($config->get('oauth-server.repository.access_token'));

        $publicKey = "-----BEGIN PUBLIC KEY-----\n"
            . wordwrap($config->get('oauth-server.public_key'), 64, "\n", true)
            . "\n-----END PUBLIC KEY-----";

        $this->server = new \League\OAuth2\Server\ResourceServer(
            $accessTokenRepository,
            $publicKey
        );
    }

    /**
     * @param Request $request
     * @return \Psr\Http\Message\ServerRequestInterface|\yunwuxin\oauth\server\Request
     */
    public function validateAuthenticatedRequest(Request $request)
    {
        $request = Bridge::fromThinkRequest($request);
        try {
            return $this->server->validateAuthenticatedRequest($request);
        } catch (OAuthServerException $exception) {
            throw new \yunwuxin\oauth\server\exception\OAuthServerException($exception);
        }
    }

}

<?php

namespace yunwuxin\oauth\server;

use DateInterval;
use GuzzleHttp\Psr7\Response;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;
use League\OAuth2\Server\Grant\ImplicitGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use think\Cache;
use think\Config;
use think\Request;
use yunwuxin\oauth\server\grant\AuthCodeGrant;
use yunwuxin\oauth\server\repositories\AccessTokenRepository;
use yunwuxin\oauth\server\repositories\AuthCodeRepository;
use yunwuxin\oauth\server\repositories\ClientRepository;
use yunwuxin\oauth\server\repositories\RefreshTokenRepository;
use yunwuxin\oauth\server\repositories\ScopeRepository;

class AuthorizationServer
{
    protected $server;

    public function __construct(Config $config, Cache $cache)
    {
        $clientRepository      = new ClientRepository($config->get('oauth-server.repository.client'));
        $scopeRepository       = new ScopeRepository();
        $accessTokenRepository = new AccessTokenRepository($config->get('oauth-server.repository.access_token'));

        $privateKey    = "-----BEGIN RSA PRIVATE KEY-----\n"
            . wordwrap($config->get('oauth-server.private_key'), 64, "\n", true)
            . "\n-----END RSA PRIVATE KEY-----";
        $encryptionKey = $config->get('oauth-server.encryption_key');

        $this->server = new \League\OAuth2\Server\AuthorizationServer(
            $clientRepository,
            $accessTokenRepository,
            $scopeRepository,
            $privateKey,
            $encryptionKey
        );

        $grunts = $config->get('oauth-server.grunts', []);

        if (in_array('auth_code', $grunts)) {
            $this->server->enableGrantType(
                new AuthCodeGrant(
                    new AuthCodeRepository($cache),
                    new RefreshTokenRepository($config->get('oauth-server.repository.refresh_token')),
                    new DateInterval('PT10M')
                )
            );
        }

        if (in_array('implicit', $grunts)) {
            $this->server->enableGrantType(
                new ImplicitGrant(new DateInterval('PT12H'))
            );
        }

        if (in_array('client_credentials', $grunts)) {
            $this->server->enableGrantType(
                new ClientCredentialsGrant()
            );
        }

        if (in_array('refresh_token', $grunts)) {
            $this->server->enableGrantType(
                new RefreshTokenGrant(new RefreshTokenRepository($config->get('oauth-server.repository.refresh_token')))
            );
        }
    }

    public function validateAuthorizationRequest(Request $request)
    {
        $request = Bridge::fromThinkRequest($request);
        try {
            $request = $this->server->validateAuthorizationRequest($request);
            return new AuthorizationRequest($request);
        } catch (OAuthServerException $exception) {
            throw new \yunwuxin\oauth\server\exception\OAuthServerException($exception);
        }
    }

    public function completeAuthorizationRequest(AuthorizationRequest $request)
    {
        $response = $this->server->completeAuthorizationRequest($request->getRequest(), new Response);
        return Bridge::toThinkResponse($response);
    }

    public function respondToAccessTokenRequest(Request $request)
    {
        $request = Bridge::fromThinkRequest($request);
        try {
            $response = $this->server->respondToAccessTokenRequest($request, new Response);
            return Bridge::toThinkResponse($response);
        } catch (OAuthServerException $exception) {
            throw new \yunwuxin\oauth\server\exception\OAuthServerException($exception);
        }
    }
}

<?php

namespace yunwuxin\oauth\server\exception;

use Exception;
use GuzzleHttp\Psr7\Response;
use yunwuxin\oauth\server\Bridge;

class OAuthServerException extends Exception
{
    protected $origin;

    public function __construct(\League\OAuth2\Server\Exception\OAuthServerException $origin)
    {
        parent::__construct($origin->getMessage(), $origin->getCode(), $origin->getPrevious());
        $this->origin = $origin;
    }

    public function generateHttpResponse($useFragment = false, $jsonOptions = 0)
    {
        $response = $this->origin->generateHttpResponse(new Response, $useFragment, $jsonOptions);
        return Bridge::toThinkResponse($response);
    }
}

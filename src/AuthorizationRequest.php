<?php

namespace yunwuxin\oauth\server;

use League\OAuth2\Server\RequestTypes\AuthorizationRequest as BaseAuthorizationRequest;
use yunwuxin\oauth\server\entities\User;

/**
 * @mixin BaseAuthorizationRequest
 */
class AuthorizationRequest
{
    public function __construct(protected BaseAuthorizationRequest $request)
    {
    }

    public function setUser($id)
    {
        $this->request->setUser(new User($id));
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->request, $name], $arguments);
    }

}

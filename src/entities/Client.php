<?php

namespace yunwuxin\oauth\server\entities;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class Client implements ClientEntityInterface
{
    use EntityTrait, ClientTrait;

    protected $scopes;

    public function __construct($identifier, $name, $redirectUri, $isConfidential = false, $scopes = [])
    {
        $this->identifier     = $identifier;
        $this->name           = $name;
        $this->redirectUri    = explode("\n", $redirectUri);
        $this->isConfidential = $isConfidential;
        $this->scopes         = $scopes;
    }

    public function getScopes()
    {
        return $this->scopes;
    }
}

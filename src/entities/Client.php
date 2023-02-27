<?php

namespace yunwuxin\oauth\server\entities;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class Client implements ClientEntityInterface
{
    use EntityTrait, ClientTrait;

    public function __construct($identifier, $name, $redirectUri, $isConfidential = false)
    {
        $this->identifier     = $identifier;
        $this->name           = $name;
        $this->redirectUri    = $redirectUri;
        $this->isConfidential = $isConfidential;
    }

}

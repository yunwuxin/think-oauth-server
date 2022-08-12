<?php

namespace yunwuxin\oauth\server\entities;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\ScopeTrait;

class Scope implements ScopeEntityInterface
{
    use EntityTrait, ScopeTrait;

    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }
}

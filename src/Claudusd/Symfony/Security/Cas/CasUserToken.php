<?php

namespace Claudusd\Symfony\Security\Cas;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class CasUserToken extends AbstractToken
{
    public function getCredentials()
    {
        return '';
    }
}
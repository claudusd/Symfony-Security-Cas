<?php

namespace Claudusd\Symfony\Security\Cas;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class CasEntryPoint implements AuthenticationEntryPointInterface
{
    protected $cas;

    public function __construct(Cas $cas)
    {
        $this->cas = $cas;
    }

    public function start(Request $request, AuthenticationException $authException = null);
    {
        return $this->cas->getLoginResponse($request)
    }
}
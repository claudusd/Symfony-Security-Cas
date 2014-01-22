<?php

namespace Claudusd\Symfony\Security\Cas\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;

class CasProviderEvent extends Event
{
    private $authenticationException;

    private $user;

    private $validUser;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
        $this->validUser = true;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }

    public function setAuthenticationException(AuthenticationException $e)
    {
        $this->authenticationException = $e;
        $this->stopPropagation();
        return $this;
    }

    public function hasAuthenticationException()
    {
        return !is_null($this->AuthenticationException);
    }

    public function getAuthenticationException()
    {
        return $this->authenticationException;
    }

    public function isValidUser()
    {
        return $this->validUser;
    }

    public function invalidUser()
    {
        $this->validUser = false;
        $this->stopPropagation();
        return $this;
    }
}
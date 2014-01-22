<?php

namespace Claudusd\Symfony\Security\Cas;

use Claudusd\Symfony\Security\Cas\Event\CasProviderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\User;

class CasProvider implements AuthenticationProviderInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function authenticate(TokenInterface $token)
    {

        $user = new User($token->getUsername(), null, array('ROLE_USER'));
        $casProviderEvent = new CasProviderEvent($user);
        $this->eventDispatcher->dispatch('cas.security.provider', $casProviderEvent);
        if ($casProviderEvent->isPropagationStopped()) {
            if($casProviderEvent->hasAuthenticationException()) {
                throw $casProviderEvent->getAuthenticationException();
            }
        }
        $authenticatedToken = new CasUserToken($casProviderEvent->getUser()->getRoles());
        $authenticatedToken->setUser($casProviderEvent->getUser());
        $authenticatedToken->setAuthenticated($casProviderEvent->isValidUser());
        return $authenticatedToken;
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof CasUserToken;
    }
}
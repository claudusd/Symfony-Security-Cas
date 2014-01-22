<?php

namespace Claudusd\Symfony\Security\Cas;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

/**
 * @author Claude Dioudonnat <claude.dioudonnat@gmail.com>
 */
class CasListener implements ListenerInterface
{
    private $cas;

    private $securityContext;

    private $authenticationManager;

    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager, Cas $cas)
    {
        $this->cas = $cas;
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
    }

    public function handle(GetResponseEvent $event)
    {
        try {
            $request = $event->getRequest();
            if ($cas->isValidationRequest($request)) {
                $response = $cas->getValidation($request);
                if ($response->isSuccess()) {
                    $token = new CasUserToken();
                    $token->setUser($response->getUsername());
                    $authToken = $this->authenticationManager->authenticate($token);
                    $this->securityContext->setToken($authToken);
                }
            }
            throw new AuthenticationException('The CAS authentication failed.');
        } catch(AuthenticationException $e) {
            $response = new Response();
            $response->setStatusCode(403);
            $event->setResponse($response);
        }
    }
}
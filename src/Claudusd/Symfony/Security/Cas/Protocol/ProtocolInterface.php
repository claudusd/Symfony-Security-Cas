<?php

namespace Claudusd\Symfony\Security\Cas\Protocol;

interface ProtocolInterface
{
    function getLoginUri($service);
    function getLogoutUri($service);
    function getValidationUri($service, $ticket);
}
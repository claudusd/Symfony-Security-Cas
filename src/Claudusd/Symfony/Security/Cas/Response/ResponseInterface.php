<?php

namespace Claudusd\Symfony\Security\Cas\Response;

interface ResponseInterface
{
    function isSuccess();
    function getUsername();
    function getAttributes();
}
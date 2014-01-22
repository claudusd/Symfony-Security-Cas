<?php

namespace Claudusd\Symfony\Security\Cas\Request;

use Claudusd\Symfony\Security\Cas\Response\ResponseInterface;

interface RequestInterface
{
    function __construct($uri);
    function setHeaders(array $headers = array());
    function setCookies(array $cookies = array());
    function setCertFile($file = null);
    function send(ResponseInterface $response);
    function getResponse();
}
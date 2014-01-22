<?php

namespace Claudusd\Symfony\Security\Cas\Request;

use Claudusd\Symfony\Security\Cas\Response\ResponseInterface;

class FileRequest extends Request implements RequestInterface
{
    public function send(ResponseInterface $response)
    {
        $this->response = $response;
        $this->response->setBody(file_get_contents($this->uri));

        return $this;
    }
}
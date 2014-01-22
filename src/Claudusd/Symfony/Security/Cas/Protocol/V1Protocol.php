<?php

namespace Claudusd\Symfony\Security\Cas\Protocol;

class V1Protocol extends Protocol implements ProtocolInterface
{
    public function getValidationUri($service, $ticket)
    {
        return $this->buildUri('validate', array(
            'service' => $this->cleanUri($service),
            'ticket' => $ticket,
        ));
    }
}
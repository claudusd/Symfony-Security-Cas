<?php

namespace Claudusd\Symfony\Security\Cas\Protocol;

class V2Protocol extends Protocol implements ProtocolInterface
{
    public function getValidationUri($service, $ticket)
    {
        return $this->buildUri('serviceValidate', array(
            'service' => $this->cleanUri($service),
            'ticket' => $ticket,
        ));
    }
}
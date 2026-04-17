<?php

namespace App\Message;

class SendEmailMessage
{
    public function __construct(
        private string $orderId,
        private string $clientEmail
    ) {}

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getClientEmail(): string
    {
        return $this->clientEmail;
    }
}

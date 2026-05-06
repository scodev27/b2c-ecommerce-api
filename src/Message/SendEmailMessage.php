<?php

namespace App\Message;

class SendEmailMessage
{
    public function __construct(
        private string $orderId,
        private string $clientEmail,
        private string $type = 'general', // 'payment_link', 'shipped', 'delivered'
        private ?string $paymentUrl = null
    ) {}

    public function getOrderId(): string { return $this->orderId; }
    public function getClientEmail(): string { return $this->clientEmail; }
    public function getType(): string { return $this->type; }
    public function getPaymentUrl(): ?string { return $this->paymentUrl; }
}

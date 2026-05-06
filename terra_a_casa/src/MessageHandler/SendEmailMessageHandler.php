<?php

namespace App\MessageHandler;

use App\Message\SendEmailMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendEmailMessageHandler
{
    public function __invoke(SendEmailMessage $message): void
    {
        sleep(3); // Simular latència conexió

        $type = $message->getType();
        $email = $message->getClientEmail();

        if ($type === 'payment_link') {
            echo "\n📧 [WORKER] Correu enviat a $email: 'Tens una comanda pendent. Paga aquí: " . $message->getPaymentUrl() . "'\n";
        } elseif ($type === 'delivering') {
            echo "\n📧 [WORKER] Correu enviat a $email: 'La teva comanda #" . $message->getOrderId() . " ja està en camí!'\n";
        } elseif ($type === 'completed') {
            echo "\n📧 [WORKER] Correu enviat a $email: 'La teva comanda #" . $message->getOrderId() . " ha estat lliurada. Que aprofiti!'\n";
        } else {
            echo "\n📧 [WORKER] Correu informatiu enviat a $email.\n";
        }
    }
}

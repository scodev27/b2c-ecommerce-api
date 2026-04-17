<?php

namespace App\MessageHandler;

use App\Message\SendEmailMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendEmailMessageHandler
{
    public function __invoke(SendEmailMessage $message): void
    {
        sleep(5);
        echo "📧 [WORKER] Email enviat correctament a: " . $message->getClientEmail() . " per a la comanda #" . $message->getOrderId() . "\n";
    }
}

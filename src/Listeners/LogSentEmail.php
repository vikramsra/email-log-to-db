<?php

namespace Vikramsra\EmailLogToDb\Listeners;

use Illuminate\Mail\Events\MessageSent;
use Vikramsra\EmailLogToDb\EmailLog;
use Symfony\Component\Mime\Email;

class LogSentEmail
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Mail\Events\MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $message = $event->message;

        if (!$message instanceof Email) {
            return;
        }

        // Get Headers
        $headers = [];
        foreach ($message->getHeaders()->all() as $header) {
            $headers[] = $header->toString();
        }
        $headers = implode("\n", $headers);

        // Get Sender
        $senderEmail = $message->getFrom() ? implode(',', array_map(fn($address) => $address->getAddress(), $message->getFrom())) : null;

        // Get Recipients, CC, and BCC
        $recipient = $message->getTo() ? implode(',', array_map(fn($address) => $address->getAddress(), $message->getTo())) : null;
        $cc = $message->getCc() ? implode(',', array_map(fn($address) => $address->getAddress(), $message->getCc())) : null;
        $bcc = $message->getBcc() ? implode(',', array_map(fn($address) => $address->getAddress(), $message->getBcc())) : null;

        // Assume that the attachment links are provided in some way (e.g., in the $event data or message metadata)
        // Here, we're simulating that an array of attachment AWS links is available.
        // In practice, you'd replace this with the actual source of your AWS links.
        $attachments = []; // An array that would hold AWS links of attachments

        // Store email data in the database
        EmailLog::create([
            'sender' => $senderEmail,
            'recipient' => $recipient,
            'cc' => $cc,
            'bcc' => $bcc,
            'subject' => $message->getSubject(),
            'body' => $message->getHtmlBody() ?? $message->getTextBody(),
            'headers' => $headers,
            'attachments' => $attachments, // Storing AWS links here
        ]);
    }
}

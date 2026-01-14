<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send an SMS message.
     *
     * @param string $to The recipient phone number
     * @param string $message The message body
     * @return bool
     */
    public function send($to, $message)
    {
        Log::info("Sending SMS to {$to}: {$message}");

        // Placeholder for SMS integration (e.g., Twilio, Vonage)
        // You would typically use a library like twilio/sdk here.

        return true;
    }
}

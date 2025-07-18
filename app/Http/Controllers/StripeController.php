<?php

namespace App\Http\Controllers;

use App\Jobs\PaymentIntentFailedJob;
use App\Jobs\PaymentIntentSucceedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use UnexpectedValueException;

class StripeController extends Controller
{
    public function __invoke(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $whSecret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $whSecret);
        } catch (UnexpectedValueException $e) {
            Log::error('Unexpected value:  '. $e->getMessage());
            return response('Invalid payload', 400);
        } catch (SignatureVerificationException $e) {
            Log::error('Unexpected signature:  '. $e->getMessage());
            return response('Invalid signature', 400);
        }

        match ($event->type) {
            'payment_intent.succeeded' => PaymentIntentSucceedJob::class,
            'payment_intent.payment_failed' => PaymentIntentFailedJob::class,
            default => Log::error('Unknown event type '. $event->type),
        };

        return response('Webhook handled', 200);
    }
}

<?php

namespace App\Jobs;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class PaymentIntentFailedJob implements ShouldQueue
{
    use Queueable;

    public object $stripeData;
    /**
     * Create a new job instance.
     */
    public function __construct(object $stripeData)
    {
        $this->stripeData = $stripeData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orderId = $this->stripeData->metadata->order_id;

        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            Log::error('Order not found');
        }

        $order->update([
            'status' => OrderStatus::Failed->value
        ]);
    }
}

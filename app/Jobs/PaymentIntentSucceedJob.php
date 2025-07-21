<?php

namespace App\Jobs;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Models\Invoice as InvoiceModel;

class PaymentIntentSucceedJob implements ShouldQueue
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

        $series = config('invoice.seriaL_number.series');

        $order->update([
            'status' => OrderStatus::Complete->value
        ]);
        $orderLines = $order->orderLines();


        $sellerCompany =  new Party([
        'name'          => 'Testas Testenis',
        'address'       => 'Akacijų aklg. 3',
        'code'          => '22663214',
        'custom_fields' => [
            'order number' => '> '.$order->id.' <',
        ],
    ]);


        $buyer = new Party([
            'name' => $this->stripeData->metadata->name,
            'address' => $this->stripeData->metadata->address,
        ]);

        $invoiceItems = [];

        foreach ($orderLines as $line) {
            $item = InvoiceItem::make($line->name)
                ->pricePerUnit($line->price_per_unit)
                ->quantity($line->quantity);


            $invoiceItems[] = $item;
        }

        $invoiceRecord = $order->invoice()->create();

        $filename = 'invoices/' . $invoiceRecord->series_no . '-' . uniqid() . '.pdf';

        $invoice = Invoice::make()
            ->series($series)
            ->sequence($invoiceRecord->id)
            ->serialNumberFormat('{SERIES}-{SEQUENCE}')
            ->seller($sellerCompany)
            ->buyer($buyer)
            ->addItems($invoiceItems)
            ->status(__('invoices::invoice.paid'))
            ->date(now())
            ->filename($filename)
            ->logo(public_path('vendor/invoices/sample-logo.png'))
            ->save('public');

        $invoiceRecord->update([
            'link' => $invoice->url()
        ]);
    }
}

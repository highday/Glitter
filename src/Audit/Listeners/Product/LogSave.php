<?php

namespace Glitter\Audit\Listeners\Product;

use Glitter\Events\ProductSaved;

class LogSave
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ProductSaved $event
     *
     * @return void
     */
    public function handle(ProductSaved $event)
    {
        if (is_null($event->actor)) {
            return;
        }

        $data = [
            'ip'         => request()->ip(),
            'ua'         => request()->header('User-Agent'),
            'product_id' => $event->product->getKey(),
            'dirty'      => $event->product->getDirty(),
        ];

        $event->actor->log('product.save', $data);
    }
}

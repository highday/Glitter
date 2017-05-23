<?php

namespace Glitter\Console\Commands;

use Glitter\Contracts\Commerce\Order\Context as OrderContext;
use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;

class OrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'glitter:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Order test';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->app = $this->getLaravel();

        $flows = [
            \Glitter\Commerce\Order\Flow\CartConvert::class,
            \Glitter\Commerce\Order\Flow\Shipping::class,
            \Glitter\Commerce\Order\Flow\Discount::class,
        ];

        $order = $this->app->make(OrderContext::class);
        $order = (new Pipeline($this->app))
                        ->send($order)
                        ->through($flows)->via('process')
                        ->then(function (OrderContext $order) {
                            return $order;
                        });

        $table = new Table($this->getOutput());
        $table->setHeaders([
            [new TableCell('Order Details', ['colspan' => 3])],
            ['Item', 'Quantity', 'Price'],
        ]);
        $rows = [];
        foreach ($order->getBoxes() as $box) {
            foreach ($box as $item) {
                $rows[] = [
                    $item->getName(),
                    $item->getQuantity(),
                    $item->getUnitPrice(),
                ];
            }
            $rows[] = new TableSeparator();
        }

        $rows[] = [
            new TableCell('Shipping', ['colspan' => 2]),
            $order->getShippingFee(),
        ];

        $rows[] = new TableSeparator();

        $rows[] = [
            new TableCell('Discount', ['colspan' => 2]),
            $order->getDiscountPirce(),
        ];

        $rows[] = new TableSeparator();

        $rows[] = [
            new TableCell('Total', ['colspan' => 2]),
            $order->getTotalPirce(),
        ];
        $table->setRows($rows);
        $table->render();
    }
}

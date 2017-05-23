<?php

namespace Glitter\Console\Commands;

use Closure;
use Illuminate\Console\Command;
use Illuminate\Contracts\Pipeline\Hub as PipelineHub;
use Illuminate\Pipeline\Pipeline;
use Glitter\Contracts\Commerce\Order\Context as OrderContext;
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
        $app = $this->getLaravel();

        $flows = [
            \Glitter\Commerce\Order\Flow\CartConvert::class,
            \Glitter\Commerce\Order\Flow\Shipping::class,
            \Glitter\Commerce\Order\Flow\Discount::class,
        ];

        $order = (new Pipeline($app))
            ->send($app->make(OrderContext::class))
            ->through($flows)->via('process')
            ->then(function (OrderContext $order) {
                return $order;
            });

        // dd($order);

        $table = new Table($this->getOutput());
        $table->setHeaders([
            [new TableCell('Order Details', ['colspan' => 3])],
            ['Item', 'Quantity', 'Price'],
        ]);
        $rows = [];
        foreach ($order as $box) {
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

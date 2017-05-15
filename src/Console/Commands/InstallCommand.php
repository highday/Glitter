<?php

namespace Highday\Glitter\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'glitter:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the commands necessary to prepare Glitter for use';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $store = \Highday\Glitter\Eloquent\Models\Store::firstOrCreate([
            'name'           => 'Highday Store',
            'account_email'  => 'store@example.com',
            'customer_email' => 'store@example.com',
            'timezone'       => 'Asia/Tokyo',
            'currency'       => 'JPY',
        ]);

        $role = \Highday\Glitter\Eloquent\Models\Role::firstOrCreate([
            'store_id'    => $store->getKey(),
            'name'        => 'Owner',
            'description' => 'Store account owner.',
        ]);

        $policy = \Highday\Glitter\Eloquent\Models\Policy::firstOrNew([
            'store_id'    => $store->getKey(),
            'name'        => 'Glitter Admin',
            'description' => 'Access to Glitter Admin.',
        ]);
        if (!$policy->exists) {
            $policy->save();
            $role->policies()->attach($policy);
        }

        $member = \Highday\Glitter\Eloquent\Models\Member::firstOrNew([
            'first_name' => 'Keisuke',
            'last_name'  => 'Nemoto',
            'email'      => 'member@example.com',
        ]);
        if (!$member->exists) {
            $member->password = bcrypt('password');
            $member->save();
            $member->stores()->attach($store);
            $member->roles()->attach($role);
        }

        $customer = \Highday\Glitter\Eloquent\Models\Customer::firstOrNew([
            'first_name' => 'Keisuke',
            'last_name'  => 'Nemoto',
            'email'      => 'customer@example.com',
        ]);
        if (!$customer->exists) {
            // $customer->password = bcrypt('password');
            $customer->save();
            $customer->stores()->attach($store);
        }

        $product = \Highday\Glitter\Eloquent\Models\Product::firstOrCreate([
            'store_id'    => $store->getKey(),
            'name'       => 'Highday original t-shirt',
            'description' => 'My first sample product.',
            'option1'     => 'Color',
            'option2'     => 'Size',
            'option3'     => null,
        ]);

        $variant[] = \Highday\Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'           => $product->getKey(),
            'option1'              => 'Black',
            'option2'              => 'S',
            'option3'              => null,
            'sku'                  => null,
            'barcode'              => null,
            'price'                => 3000,
            'reference_price'      => null,
            'taxes_included'		=>1,
            'inventory_management' => 'glitter',
            'inventory_quantity'   => 100,
            'out_of_stock_purchase'=>1,
            'requires_shipping'    => true,
            'fulfillment_service'  =>1
        ]);

        $variant[] = \Highday\Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'           => $product->getKey(),
            'option1'              => 'Black',
            'option2'              => 'M',
            'option3'              => null,
            'sku'                  => null,
            'barcode'              => null,
            'price'                => 3000,
            'reference_price'      => null,
            'taxes_included'		=>1,
            'inventory_management' => 'glitter',
            'inventory_quantity'   => 100,
            'out_of_stock_purchase'=>1,
            'requires_shipping'    => true,
            'fulfillment_service'  =>1
        ]);

        $variant[] = \Highday\Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'           => $product->getKey(),
            'option1'              => 'Black',
            'option2'              => 'L',
            'option3'              => null,
            'sku'                  => null,
            'barcode'              => null,
            'price'                => 3000,
            'reference_price'      => null,
            'taxes_included'		=>1,
            'inventory_management' => 'glitter',
            'inventory_quantity'   => 100,
            'out_of_stock_purchase'=>1,
            'requires_shipping'    => true,
            'fulfillment_service'  =>1
        ]);

        $variant[] = \Highday\Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'           => $product->getKey(),
            'option1'              => 'White',
            'option2'              => 'S',
            'option3'              => null,
            'sku'                  => null,
            'barcode'              => null,
            'price'                => 3000,
            'reference_price'      => null,
            'taxes_included'		=>1,
            'inventory_management' => 'glitter',
            'inventory_quantity'   => 100,
            'out_of_stock_purchase'=>1,
            'requires_shipping'    => true,
            'fulfillment_service'  =>1
        ]);

        $variant[] = \Highday\Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'           => $product->getKey(),
            'option1'              => 'White',
            'option2'              => 'M',
            'option3'              => null,
            'sku'                  => null,
            'barcode'              => null,
            'price'                => 3000,
            'reference_price'      => null,
            'taxes_included'		=>1,
            'inventory_management' => 'glitter',
            'inventory_quantity'   => 100,
            'out_of_stock_purchase'=>1,
            'requires_shipping'    => true,
            'fulfillment_service'  =>1
        ]);

        $variant[] = \Highday\Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'           => $product->getKey(),
            'option1'              => 'White',
            'option2'              => 'L',
            'option3'              => null,
            'sku'                  => null,
            'barcode'              => null,
            'price'                => 3000,
            'reference_price'      => null,
            'taxes_included'		=>1,
            'inventory_management' => 'glitter',
            'inventory_quantity'   => 100,
            'out_of_stock_purchase'=>1,
            'requires_shipping'    => true,
            'fulfillment_service'  =>1
        ]);
    }
}

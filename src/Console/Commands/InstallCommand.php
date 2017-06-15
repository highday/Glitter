<?php

namespace Glitter\Console\Commands;

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
        $store = \Glitter\Eloquent\Models\Store::firstOrCreate([
            'name'           => 'Highday Store',
            'account_email'  => 'store@example.com',
            'customer_email' => 'store@example.com',
            'timezone'       => 'Asia/Tokyo',
            'currency'       => 'JPY',
        ]);

        $role = \Glitter\Eloquent\Models\Role::firstOrCreate([
            'store_id'    => $store->getKey(),
            'built_in'    => true,
            'name'        => 'ストアオーナー',
            'description' => 'ストアアカウントの所有者',
        ]);

        $role2 = \Glitter\Eloquent\Models\Role::firstOrCreate([
            'store_id'    => $store->getKey(),
            'built_in'    => false,
            'name'        => 'ストアスタッフ',
            'description' => '店員用アカウント',
        ]);

        $policy = \Glitter\Eloquent\Models\Policy::firstOrNew([
            'store_id'    => $store->getKey(),
            'name'        => 'バックオフィス',
            'description' => 'バックオフィスにアクセス可能',
        ]);
        if (!$policy->exists) {
            $policy->save();
            $role->policies()->attach($policy);
            $role2->policies()->attach($policy);
        }

        $member = \Glitter\Eloquent\Models\Member::firstOrNew([
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

        $customer = \Glitter\Eloquent\Models\Customer::firstOrNew([
            'first_name' => 'Keisuke',
            'last_name'  => 'Nemoto',
            'email'      => 'customer@example.com',
        ]);
        if (!$customer->exists) {
            // $customer->password = bcrypt('password');
            $customer->save();
            $customer->stores()->attach($store);
        }

        $product = \Glitter\Eloquent\Models\Product::firstOrCreate([
            'store_id'    => $store->getKey(),
            'name'        => 'Highday original t-shirt',
            'description' => 'My first sample product.',
            'option1'     => 'Color',
            'option2'     => 'Size',
            'option3'     => null,
        ]);

        $variant[] = \Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'            => $product->getKey(),
            'option1'               => 'Black',
            'option2'               => 'S',
            'option3'               => null,
            'sku'                   => null,
            'barcode'               => null,
            'price'                 => 3000,
            'reference_price'       => null,
            'taxes_included'        => 1,
            'inventory_management'  => 'glitter',
            'inventory_quantity'    => 100,
            'out_of_stock_purchase' => 1,
            'requires_shipping'     => true,
            'fulfillment_service'   => 1,
        ]);

        $variant[] = \Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'            => $product->getKey(),
            'option1'               => 'Black',
            'option2'               => 'M',
            'option3'               => null,
            'sku'                   => null,
            'barcode'               => null,
            'price'                 => 3000,
            'reference_price'       => null,
            'taxes_included'        => 1,
            'inventory_management'  => 'glitter',
            'inventory_quantity'    => 100,
            'out_of_stock_purchase' => 1,
            'requires_shipping'     => true,
            'fulfillment_service'   => 1,
        ]);

        $variant[] = \Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'            => $product->getKey(),
            'option1'               => 'Black',
            'option2'               => 'L',
            'option3'               => null,
            'sku'                   => null,
            'barcode'               => null,
            'price'                 => 3000,
            'reference_price'       => null,
            'taxes_included'        => 1,
            'inventory_management'  => 'glitter',
            'inventory_quantity'    => 100,
            'out_of_stock_purchase' => 1,
            'requires_shipping'     => true,
            'fulfillment_service'   => 1,
        ]);

        $variant[] = \Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'            => $product->getKey(),
            'option1'               => 'White',
            'option2'               => 'S',
            'option3'               => null,
            'sku'                   => null,
            'barcode'               => null,
            'price'                 => 3000,
            'reference_price'       => null,
            'taxes_included'        => 1,
            'inventory_management'  => 'glitter',
            'inventory_quantity'    => 100,
            'out_of_stock_purchase' => 1,
            'requires_shipping'     => true,
            'fulfillment_service'   => 1,
        ]);

        $variant[] = \Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'            => $product->getKey(),
            'option1'               => 'White',
            'option2'               => 'M',
            'option3'               => null,
            'sku'                   => null,
            'barcode'               => null,
            'price'                 => 3000,
            'reference_price'       => null,
            'taxes_included'        => 1,
            'inventory_management'  => 'glitter',
            'inventory_quantity'    => 100,
            'out_of_stock_purchase' => 1,
            'requires_shipping'     => true,
            'fulfillment_service'   => 1,
        ]);

        $variant[] = \Glitter\Eloquent\Models\Variant::firstOrCreate([
            'product_id'            => $product->getKey(),
            'option1'               => 'White',
            'option2'               => 'L',
            'option3'               => null,
            'sku'                   => null,
            'barcode'               => null,
            'price'                 => 3000,
            'reference_price'       => null,
            'taxes_included'        => 1,
            'inventory_management'  => 'glitter',
            'inventory_quantity'    => 100,
            'out_of_stock_purchase' => 1,
            'requires_shipping'     => true,
            'fulfillment_service'   => 1,
        ]);
    }
}

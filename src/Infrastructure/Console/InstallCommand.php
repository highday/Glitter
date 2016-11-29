<?php

namespace Highday\Glitter\Infrastructure\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'glitter:install';

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
        $store = \Highday\Glitter\Infrastructure\Eloquents\Store::firstOrCreate([
            'slug' => 'my-store',
            'name' => 'My Store',
        ]);

        $role = \Highday\Glitter\Infrastructure\Eloquents\Role::firstOrCreate([
            'store_id'    => $store->getKey(),
            'name'        => 'Admin',
            'description' => '',
        ]);

        $member = \Highday\Glitter\Infrastructure\Eloquents\Member::firstOrNew([
            'name'  => 'member',
            'email' => 'member@example.com',
        ]);
        if (!$member->exists) {
            $member->password = bcrypt('password');
            $member->save();
        }
        $member->stores()->attach($store);
        $member->roles()->attach($role);

        // $customer = \Highday\Glitter\Infrastructure\Eloquents\Customer::create([
        //     'name' => 'nemooon',
        //     'email' => 'n@on-lab.jp',
        //     'password' => bcrypt('password'),
        // ]);
    }
}

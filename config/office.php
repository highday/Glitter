<?php

return [

    'auth' => [

        'guards' => [
            'member' => [
                'driver'   => 'session',
                'provider' => 'members',
            ],
        ],

        'providers' => [
            'members' => [
                'driver' => 'eloquent',
                'model'  => Glitter\Eloquent\Models\Member::class,
            ],
        ],

        'passwords' => [
            'member' => [
                'provider' => 'members',
                'table'    => 'password_resets',
                'expire'   => 60,
            ],
        ],

    ],

    'finder' => [
        'customers' => [
            \Glitter\Services\Office\Customer\Finder\All::class,
            \Glitter\Services\Office\Customer\Finder\Mailmagazine::class,
            \Glitter\Services\Office\Customer\Finder\Repeater::class,
            \Glitter\Services\Office\Customer\Finder\Lead::class,
        ],
    ],
];

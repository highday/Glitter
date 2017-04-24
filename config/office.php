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
                'model'  => Highday\Glitter\Eloquent\Models\Member::class,
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

];

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
        'all' => [
            'label' => 'すべて',
            'callback' => \Glitter\Services\Office\Customer\Finder\All::class,
            'default' => true
        ],
        'mailmagazine' => [
            'label'    => 'メルマガ購読',
            'callback' => \Glitter\Services\Office\Customer\Finder\Mailmagazine::class
        ],
        'repeater'     => [
            'label'    => 'リピート客',
            'callback' => \Glitter\Services\Office\Customer\Finder\Repeater::class
        ],
        'lead'         => [
            'label'    => '見込み客',
            'callback' => \Glitter\Services\Office\Customer\Finder\Lead::class
        ]
    ]
];

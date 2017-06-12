<?php

use Glitter\Http\Controllers\Office\Customer\Finder;

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
            'mailmagazine' => [
                'label'    => 'メールマガジン',
                'callback' => Finder\MailMagazine::class,
            ],
            'repeaters'    => [
                'label'    => 'リピーター',
                'callback' => Finder\Repeater::class,
            ],
            'lead'         => [
                'label'    => '見込み顧客',
                'callback' => Finder\Lead::class,
            ],

        ],
    ],

];

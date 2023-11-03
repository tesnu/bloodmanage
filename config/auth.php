<?php

return [


    'defaults' => [
        'guard' => 'employee',
    ],



    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
        'hospital' => [
            'driver' => 'session',
            'provider' => 'hospital',
        ],
        'employee' => [
            'driver' => 'session',
            'provider' => 'employee',
        ]
    ],


    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'hospital' => [
            'driver' => 'eloquent',
            'model' => App\Models\Hospital::class,
        ],
        'employee' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employee::class,
        ],

    ],


];

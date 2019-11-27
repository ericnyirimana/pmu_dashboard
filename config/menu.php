<?php
return [

  'admin' => [
        'Dashboard' => [
            'icon' => 'fi-air-play',
            'routes' => [
                'Dashboard' => 'dashboard.index',
                'Blank' => 'dashboard.blank',
            ],
        ],
        'Brands' => [
            'icon' => 'fi-star',
            'routes' => [
                'List' => 'brands.index',
                'New' => 'brands.create',
            ],
        ],
        'Restaurants' => [
            'icon' => 'fi-cutlery',
            'routes' => [
                'List' => 'restaurants.index',
                'New' => 'restaurants.create',
            ],
        ],
        'Account' => [
            'icon' => 'fi-head',
            'routes' => [
                'List' => 'users.index',
                'New' => 'users.create',
            ],
        ],
        'Media' => [
            'icon' => 'fi-camera',
            'routes' => [
                'List' => 'media.index',
            ],
        ],
    ]

];

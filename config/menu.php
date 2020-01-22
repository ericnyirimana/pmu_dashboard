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
        'Company' => [
            'icon' => 'fi-star',
            'routes' => [
                'List' => 'brands.index',
                'New' => 'brands.create',
            ],
        ],
        'Menu' => [
            'icon' => 'fi-align-center',
            'routes' => [
                'List' => 'menu.index',
                'New' => 'menu.create',
                'List Dishes' => 'products.index',
                'New Dish' => 'products.create'
            ],
        ],
        'Categories' => [
            'icon' => 'fi-align-center',
            'routes' => [
                'List' => 'categories.index',
                'New' => 'categories.create',
            ],
        ],
        'Restaurants' => [
            'icon' => 'fi-paper',
            'routes' => [
                'List' => 'restaurants.index',
            ],
        ],
        'Account' => [
            'icon' => 'fi-head',
            'routes' => [
                'Profile' => 'users.profile',
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

<?php
return [

  'admin' => [
        'Dashboard' => [
            'class'   => '',
            'icon' => 'fi-air-play',
            'routes' => [
                'Dashboard' => 'dashboard.index',
            ],
        ],
        'Company' => [
            'class'   => 'Company',
            'icon'    => 'fi-star',
            'routes'  => [
                'List'  => 'companies.index',
                'New'   => 'companies.create',
            ],
        ],
        'Categories' => [
            'class'   => 'Category',
            'icon' => 'fi-align-center',
            'routes' => [
                'List' => 'categories.index',
                'New' => 'categories.create',
            ],
        ],
        'Dishes' => [
            'class'   => 'Product',
            'icon' => 'fi-align-center',
            'routes' => [
                'List' => 'products.index',
                'New Dish' => 'products.create.dish',
                'New Drink' => 'products.create.drink',
            ],
        ],
        'Menu' => [
            'class'   => 'Menu',
            'icon' => 'fi-align-center',
            'routes' => [
                'List' => 'menu.index',
                'New' => 'menu.create'
            ],
        ],
        'Offer and Subscription' => [
            'class'   => 'Pickup',
            'icon' => 'fi-tag',
            'routes' => [
                'List' => 'pickups.index',
                'New' => 'pickups.create'
            ],
        ],
        'Fasce orarie' => [
            'class'   => 'Mealtype',
            'icon' => 'fi-clock',
            'routes' => [
                'List' => 'mealtypes.index',
                'New' => 'mealtypes.create'
            ],
        ],
        'Account' => [
            'class'   => 'User',
            'icon' => 'fi-head',
            'routes' => [
                'Profile' => 'users.profile',
                'User' => 'users.index',
                'New' => 'users.create',
            ],
        ],
        'Media' => [
            'class'   => 'Media',
            'icon' => 'fi-camera',
            'routes' => [
                'List' => 'media.index',
            ],
        ],
    ]

];

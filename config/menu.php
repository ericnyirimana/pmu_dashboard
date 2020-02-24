<?php
return [

  'admin' => [
        'Dashboard' => [
            'class'   => '',
            'icon' => 'fi-air-play',
            'routes' => [
                'Dashboard' => 'dashboard.index',
                'Blank' => 'dashboard.blank',
            ],
        ],
        'Company' => [
            'class'   => 'Brand',
            'icon'    => 'fi-star',
            'routes'  => [
                'List'  => 'brands.index',
                'New'   => 'brands.create',
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
        'Dishes' => [
            'class'   => 'Product',
            'icon' => 'fi-align-center',
            'routes' => [
                'List' => 'products.index',
                'New Dish' => 'products.create.dish',
                'New Drink' => 'products.create.drink',
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
        'Restaurants' => [
            'class'   => 'Restaurant',
            'icon' => 'fi-paper',
            'routes' => [
                'List' => 'restaurants.index',
            ],
        ],
        'Account' => [
            'class'   => 'User',
            'icon' => 'fi-head',
            'routes' => [
                'Profile' => 'users.profile',
                'List' => 'users.index',
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

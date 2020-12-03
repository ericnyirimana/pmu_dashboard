<?php
return [

    'admin' => [
        'dashboard' => [
            'class' => 'Dashboard',
            'icon' => 'fi-air-play',
            'routes' => [
                'home' => 'dashboard.index',
            ],
        ],
        'company' => [
            'class' => 'Company',
            'icon' => 'fi-star',
            'routes' => [
                'list' => 'companies.index',
                'new' => 'companies.create',
            ],
        ],
        'orders' => [
            'class' => 'Order',
            'icon' => 'fi-bag',
            'routes' => [
                'list' => 'orders.index',
            ],
        ],
        'categories' => [
            'class' => 'Category',
            'icon' => 'fi-align-center',
            'routes' => [
                'list' => 'categories.index',
                'new' => 'categories.create',
            ],
        ],
        'dishes' => [
            'class' => 'Product',
            'icon' => 'fi-align-center',
            'routes' => [
                'list' => 'products.index',
                'new_dish' => 'products.create.dish',
                'new_drink' => 'products.create.drink',
            ],
        ],
        'menu' => [
            'class' => 'Menu',
            'icon' => 'fi-align-center',
            'routes' => [
                'list' => 'menu.index',
                'new' => 'menu.create'
            ],
        ],
        'offer_subscription' => [
            'class' => 'Pickup',
            'icon' => 'fi-tag',
            'routes' => [
                'list' => 'pickups.index',
                'new' => 'pickups.create',
                //'calendar_offer' => 'pickups.calendar'
            ],
        ],
        'loyalty_card' => [
            'class' => 'LoyaltyCardProduct',
            'icon' => 'fi-paper',
            'routes' => [
                'list' => 'loyalty-card.index',
                'new' => 'loyalty-card.create',
            ],
        ],
        'mealtypes' => [
            'class' => 'Mealtype',
            'icon' => 'fi-clock',
            'routes' => [
                'list' => 'mealtypes.index',
                'new' => 'mealtypes.create'
            ],
        ],
        'timeslots' => [
            'class' => 'Timeslots',
            'icon' => 'fi-clock',
            'routes' => [
                'list' => 'timeslots.index',
                'new' => 'timeslots.create'
            ],
        ],
        'showcases' => [
            'class' => 'Showcase',
            'icon' => 'fi-align-center',
            'routes' => [
                'list' => 'showcases.index'
            ],
        ],
        'account' => [
            'class' => 'User',
            'icon' => 'fi-head',
            'routes' => [
                'profile' => 'users.profile',
                'user' => 'users.index',
                'new' => 'users.create',
            ],
        ],
        'media' => [
            'class' => 'Media',
            'icon' => 'fi-camera',
            'routes' => [
                'list' => 'media.index',
            ],
        ],
    ]

];

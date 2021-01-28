<?php
return [

    'admin' => [
        'dashboard' => [
            'class' => 'Dashboard',
            'icon' => 'fi-air-play',
            'new' => false,
            'routes' => [
                'home' => 'dashboard.index',
            ],
        ],
        'company' => [
            'class' => 'Company',
            'icon' => 'fi-star',
            'new' => false,
            'routes' => [
                'list' => 'companies.index',
                'new' => 'companies.create',
            ],
        ],
        'orders' => [
            'class' => 'Order',
            'new' => true,
            'icon' => 'fi-bag',
            'routes' => [
                'list_order' => 'orders.index',
                'list_subscription' => 'subscriptions.index',
            ],
        ],
        'categories' => [
            'class' => 'Category',
            'icon' => 'fi-align-center',
            'new' => false,
            'routes' => [
                'list' => 'categories.index',
                'new' => 'categories.create',
            ],
        ],
        'dishes' => [
            'class' => 'Product',
            'icon' => 'fi-align-center',
            'new' => false,
            'routes' => [
                'list' => 'products.index',
                'new_dish' => 'products.create.dish',
                'new_drink' => 'products.create.drink',
            ],
        ],
        'menu' => [
            'class' => 'Menu',
            'icon' => 'fi-align-center',
            'new' => false,
            'routes' => [
                'list' => 'menu.index',
                'new' => 'menu.create'
            ],
        ],
        'offer_subscription' => [
            'class' => 'Pickup',
            'icon' => 'fi-tag',
            'new' => false,
            'routes' => [
                'list' => 'pickups.index',
                'new' => 'pickups.create',
                //'calendar_offer' => 'pickups.calendar'
            ],
        ],
        'loyalty_card' => [
            'class' => 'LoyaltyCardProduct',
            'icon' => 'fi-paper',
            'new' => true,
            'routes' => [
                'list' => 'loyalty-card.index',
                'new' => 'loyalty-card.create',
            ],
        ],
        'mealtypes' => [
            'class' => 'Mealtype',
            'icon' => 'fi-clock',
            'new' => false,
            'routes' => [
                'list' => 'mealtypes.index',
                'new' => 'mealtypes.create'
            ],
        ],
        'timeslots' => [
            'class' => 'Timeslots',
            'icon' => 'fi-clock',
            'new' => false,
            'routes' => [
                'list' => 'timeslots.index',
                'new' => 'timeslots.create'
            ],
        ],
        'showcases' => [
            'class' => 'Showcase',
            'icon' => 'fi-align-center',
            'new' => false,
            'routes' => [
                'list' => 'showcases.index'
            ],
        ],
        'account' => [
            'class' => 'User',
            'icon' => 'fi-head',
            'new' => false,
            'routes' => [
                'profile' => 'users.profile',
                'user' => 'users.index',
                'new' => 'users.create',
            ],
        ],
        'media' => [
            'class' => 'Media',
            'icon' => 'fi-camera',
            'new' => false,
            'routes' => [
                'list' => 'media.index',
            ],
        ],
    ]

];

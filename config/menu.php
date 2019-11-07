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
        'Users' => [
            'icon' => 'fi-briefcase',
            'routes' => [
                'List' => 'user.list',
                'New' => 'user.new',
            ],
        ],
    ]

];

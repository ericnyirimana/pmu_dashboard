<?php

return [
    // AWS Settings
    'credentials'       => [
        'key'    => env('AWS_ACCESS_KEY_ID', ''),
        'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
    ],
    'region'            => env('AWS_DEFAULT_REGION', 'us-east-1'),
    'version'           => env('AWS_COGNITO_VERSION', 'latest'),
    'app_client_id'     => env('AWS_COGNITO_CLIENT_ID', ''),
    'app_client_secret' => env('AWS_COGNITO_CLIENT_SECRET', ''),
    'user_pool_id'      => env('AWS_COGNITO_USER_POOL_ID', ''),

    // package configuration
    'use_sso'           => env('USE_SSO', false),
    'sso_user_fields'   => [
        'name',
        'email',
    ],
    'sso_user_model'        => 'App\Models\User',
    'delete_user'           => env('AWS_COGNITO_DELETE_USER', false),
    'user_attributes'        => [
        'sub',
        'name',
        'email',
        'custom:role',
    ],
    'roles' => [
      'ADMIN'           => 'ADMIN',
      'PMU'             => 'PMU',
      'OWNER'           => 'OWNER',
      'RESTAURATEUR'    => 'RESTAURATEUR',
      'CUSTOMER'        => 'CUSTOMER',
      'SALES ASSISTANT' => 'SALES ASSISTANT'
    ],
    'restaurantoRolesToAdd' => [
        'SALES_ASSISTANT' => 'SALES ASSISTANT'
    ],
    'ownerRolesToAdd' => [
        'RESTAURATEUR'    => 'RESTAURATEUR',
        'SALES ASSISTANT' => 'SALES ASSISTANT'
    ],

];

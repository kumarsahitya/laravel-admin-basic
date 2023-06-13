<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Brand Name
    |--------------------------------------------------------------------------
    |
    | This will be displayed on the login page and in the sidebar's header.
    |
    */

    'brand' => null,

    'mapbox_token' => env('MAPBOX_PUBLIC_TOKEN', null),

    /*
    |--------------------------------------------------------------------------
    | Locale Configuration
    |--------------------------------------------------------------------------
    |
    | PHP locale determines the default locale that will be used
    | by the model date format function ->formatLocalized().
    |
    */

    'locale' => 'en_EN',

    /*
    |--------------------------------------------------------------------------
    | Resource
    |--------------------------------------------------------------------------
    |
    | Automatically connect the stored links. For example js and css files.
    |
    */

    'resources' => [
        'stylesheets' => [],
        'scripts' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Define the way the Sidebar should be cached.
    | The cache store defined by the Laravel.
    |
    | Available: "null" , "static", "user-based"
    |
    */

    'cache' => [
        'method' => null,
        'duration' => 1440,
    ],

    /*
    |--------------------------------------------------------------------------
    | Configurations for the user
    |--------------------------------------------------------------------------
    |
    | User configuration to manage user access using spatie/laravel-permission.
    |
    */

    'users' => [
        'admin_role' => 'administrator',
        'default_role' => 'user',
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Table Prefix
    |--------------------------------------------------------------------------
    |
    | This prefix table can be used for the prefix of each
    | tables in your database. For example your products table will have
    | the current name `sp_products` if you are using 'sp_' as tables prefix.
    |
    | Eg: 'table_prefix' => 'sp_'
    |
    */

    'table_prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Controllers config
    |--------------------------------------------------------------------------
    |
    | If you want extends your admin panel with great features,
    | Here you can specify custom Controller Namespace and
    | RouteServiceProvider will load all your controllers.
    |
    */

    'controllers' => [
        'namespace' => 'App\\Http\\Controllers',
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage
    |--------------------------------------------------------------------------
    |
    | Specifies the configuration for resource storage, such as users avatars
    | and upload files.
    |
    */

    'storage' => [

        'disks' => [

            /*
             * Avatars folder uploads picture.
             *
             * Create this disk under the `filesystems.php` config file if not exist.
             */
            'avatars' => 'avatars',

            /*
             * Uploads folders uploads files.
             *
             * Create this disk under the filesystems.php config file if not exist.
             */
            'uploads' => 'uploads',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Barcode type
    |--------------------------------------------------------------------------
    |
    | Allows you to choose what type of barcode you want to use for your products
    | This feature uses the milon/barcode package. The list of code types
    | is available here. https://github.com/milon/barcode#1d-barcodes
    |
    */

    'barcode_type' => 'C128',

];

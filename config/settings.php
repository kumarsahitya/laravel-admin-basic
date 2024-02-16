<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Setting Menu
    |--------------------------------------------------------------------------
    |
    | The menu for the generation of the page settings and layout.
    | BladeUIKit Heroicon is the icon used. See https://blade-ui-kit.com/blade-icons?set=1
    |
     */

    'items' => [
        [
            'name' => 'General',
            'description' => 'View and update your store information.',
            'icon' => 'bx bx-cog',
            'route' => 'admin.settings.shop',
            'permission' => null,
        ],
        [
            'name' => 'Staff & permissions',
            'description' => 'View and manage what staff can see or do in your store.',
            'icon' => 'bx bx-group',
            'route' => 'admin.settings.users',
            'permission' => null,
        ],
        [
            'name' => 'Legal',
            'description' => 'Manage your store\'s legal pages such as privacy, terms.',
            'icon' => 'bx bxs-lock-alt',
            'route' => 'admin.settings.legal',
            'permission' => null,
        ],
    ],
];

<?php

return [
    'permissions' => [
        'new' => 'New permission',
        'new_description' => 'Add a new permission and directly assign to this role',
        'labels' => [
            'name' => 'Permission name (in lowercase)',
        ],
    ],

    'roles' => [
        'new' => 'Add new role',
        'new_description' => 'Add a new role and assign permissions for administrators.',
        'labels' => [
            'name' => 'Name (in lowercase)',
        ],
        'confirm_delete_msg' => 'Are you sure you want to remove this role? All users who had this role will no longer be able to access the actions given by this role',
    ],

];

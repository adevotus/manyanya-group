<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadmin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'manager' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'muhasibu' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'storekeeper' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'mechanics' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'driver' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

<?php

use App\Http\Models\Enums\Permissions;

return [
    'Dashboard_admin' => [
        'id' => 'dashboard_admin',
        'icon' => 'fa-tachometer-alt',
        'url' => null,
        'permission' => Permissions::$admin,
        'trans' => 'Inicio',
        'subMenu' => [],
    ],
    'Config_admin' => [
        'id' => 'config_admin',
        'icon' => 'fa-cogs',
        'url' => null,
        'permission' => Permissions::$admin,
        'trans' => 'Configuracion',
        'subMenu' => [
            'Principal_admin' => [
                'id' => 'principal_admin',
                'icon' => '',
                'url' => null,
                'permission' => Permissions::$admin,
                'trans' => 'Principal',
                'subMenu' => [],
            ],
        ],
    ]
];
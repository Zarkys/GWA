<?php

use App\Http\Models\Enums\Permissions;

return [
    'Dashboard_operator' => [
        'id' => 'dashboard_admin',
        'icon' => 'fa-tachometer-alt',
        'url' => null,
        'permission' => Permissions::$client,
        'trans' => 'Inicio',
        'subMenu' => [],
    ],
];
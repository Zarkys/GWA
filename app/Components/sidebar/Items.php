<?php

namespace App\Components\sidebar;

use App\Components\Helper;

class Items extends \App\Http\Controllers\Controller
{
    public static function sidebar()
    {
        return Helper::array_object(array_merge(
            Helper::sidebar('admin'),
            Helper::sidebar('client')
        ));
    }
}
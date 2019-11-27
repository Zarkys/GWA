<?php

namespace Modules\Products\Models\Entities;

use Illuminate\Database\Seeder;

class CurrenciesProductsTableSeeder extends Seeder
{

    public function run()
    {

        CurrencyProduct::create([
            'iso' => 'USD',
            'name' => 'United States Dollar',
            'symbol' => '$',
            'thousand_separator' => ',',
            'decimal_separator' => '.',
            'decimals' => 2,
            'active' => 0
        ]);

        CurrencyProduct::create([
            'iso' => 'VEF',
            'name' => 'Venezuelan Bolívar Fuerte',
            'symbol' => 'BsF.',
            'thousand_separator' => '.',
            'decimal_separator' => ',',
            'decimals' => 2,
            'active' => 1
        ]);

        CurrencyProduct::create([
            'iso' => 'BRL',
            'name' => 'Real Brasilero',
            'symbol' => 'R',
            'thousand_separator' => ',',
            'decimal_separator' => '.',
            'decimals' => 2,
            'active' => 0
        ]);

        CurrencyProduct::create([
            'iso' => 'PEN',
            'name' => 'Soles Peruanos',
            'symbol' => 'S/',
            'thousand_separator' => ',',
            'decimal_separator' => '.',
            'decimals' => 2,
            'active' => 0
        ]);

        CurrencyProduct::create([
            'iso' => 'COP',
            'name' => 'Pesos colombianos',
            'symbol' => '$',
            'thousand_separator' => ',',
            'decimal_separator' => '.',
            'decimals' => 2,
            'active' => 0
        ]);

        CurrencyProduct::create([
            'iso' => 'CLP',
            'name' => 'Pesos chiles',
            'symbol' => '$',
            'thousand_separator' => ',',
            'decimal_separator' => '.',
            'decimals' => 2,
            'active' => 0
        ]);

        CurrencyProduct::create([
            'iso' => 'EUR',
            'name' => 'Euros',
            'symbol' => '€',
            'thousand_separator' => ',',
            'decimal_separator' => '.',
            'decimals' => 2,
            'active' => 0
        ]);
    }
}

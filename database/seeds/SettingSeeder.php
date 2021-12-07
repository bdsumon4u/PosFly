<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Insert some stuff
        DB::table('settings')->insert(
            array(
                'id' => 1,
                'email' => 'admin@admin.com',
                'currency_id' => 1,
                'client_id' => 1,
                'warehouse_id' => Null,
                'CompanyName' => config('app.name', 'PosFly'),
                'CompanyPhone' => '0123456789',
                'CompanyAdress' => 'Mirpur-10, Dhaka-BD.',
                'footer' => config('app.name', 'PosFly').' - Ultimate Inventory With POS',
                'developed_by' => 'Cyber 32',
                'logo' => '/images/logo.png',
            )

        );
    }
}

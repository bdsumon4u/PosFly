<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	// Insert some stuff
        DB::table('clients')->insert(
            array(
                'id'     => 1,
                'name'   => 'walk-in-customer',
                'code' => 1,
                'email' => 'walk-in-customer@example.com',
                'country' => 'Bangladesh',
                'city' => 'Dhaka',
                'phone' => '0123456789',
                'adresse' => 'Mirpur-10 , Dhaka-BD.',
            )

        );
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Insert some stuff
        DB::table('users')->insert(
            array(
                'id' => 1,
                'firstname' => 'Cyber',
                'lastname' => '32',
                'username' => 'cyber32',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$ZPsWuR1eeBlIDyeC6VYCLuZFlOh7fpT6Inww.9KPFNlPTe.Mu7Yhu',
                'avatar' => '/images/avatar/no_avatar.png',
                'phone' => '0123456789',
                'role_id' => 1,
                'statut' => 1,
            )
        );
    }
}

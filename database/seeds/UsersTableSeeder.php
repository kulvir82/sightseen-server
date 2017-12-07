<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "sedding users\n";
        DB::table('users')->insert([
        	'username'     => 'admin',
            'email'        => 'admin@bookmysightseen.com',
            'password'     => bcrypt('123456789'),
            'phone_number' => '4653785634789',
            'is_admin'     => 1,
            'created_at'   => Carbon\Carbon::now(),
            'updated_at'   => Carbon\Carbon::now(),
        ]);
    }
}

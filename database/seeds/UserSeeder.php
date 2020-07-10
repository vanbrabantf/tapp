<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@tappnetwork.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
    }
}

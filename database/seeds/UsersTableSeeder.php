<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = new User([
            'name' => 'John Dave Decano',
            'email' => 'user@user.com',
            'password' => '123456'
        ]);

        $user->save();
    }
}

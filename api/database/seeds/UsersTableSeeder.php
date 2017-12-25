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
            'password' => '123456',
            'is_activated' => true,
        ]);

        $user->save();

        factory(App\User::class, 10)->create(['is_superadmin' => true]);

        factory(App\User::class, 10)->create(['is_superadmin' => false]);
    }
}

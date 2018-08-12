<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allUsers = [
            ['name' => 'System Admin', 'email' => 'sysAdmin@example.com', 'password' => Hash::make('development'), 'type' => 'admin'],
            ['name' => 'System Member', 'email' => 'sysMember@example.com', 'password' => Hash::make('development'), 'type' => 'member'],
            ['name' => 'System Member 1', 'email' => 'sysMember1@example.com', 'password' => Hash::make('development'), 'type' => 'member']
        ];
        foreach ($allUsers as $user)
        {
            User::create($user);
        }
    }
}

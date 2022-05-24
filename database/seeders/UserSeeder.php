<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('slug','manager')->first();

        $user = User::create([
            'name' => 'Менеджер',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        $user->roles()->attach($role);
    }
}

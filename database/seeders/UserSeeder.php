<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User([
            'name' => 'Super Administrador',
            'username' => 'super-admin',
            'email' => 'super-admin@bg-app.com',
            'password' => bcrypt('password'),
        ]);

        $user->save();
        $user->syncRoles(['super-administrador']);
    }
}

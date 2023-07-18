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
            'document' => 1234567890,
            'username' => 'super-admin',
            'email' => 'super-admin@bg-app.com',
            'password' => bcrypt('password'),
            'type_document_identification_id' => 1,
        ]);

        $user->save();
        $user->syncRoles(['super-administrador']);

        $users = User::factory()->count(10)->create();

    }
}

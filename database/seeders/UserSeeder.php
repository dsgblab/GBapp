<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User([
            'name' => 'Super Administrator',
            'username' => 'superadmin',
            'email' => 'admin@ca-mejia.com',
            'password' => Hash::make('S3cur3-P4ssw0rd*')
        ]);

        $user->save();
        $user->syncRoles(['super-admin']);
    }
}

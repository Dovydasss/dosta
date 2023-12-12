<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
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
        // Create or find the role

        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@dosta.com',
            'password' => Hash::make('password') // Use a strong password
        ]);

        // Assign admin role to user
        $adminUser->assignRole('admin');
    }
}


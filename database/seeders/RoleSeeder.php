<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; 
use App\Models\User; 

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'owner',
        ]);

        $fundraiserRole = Role::create([
            'name' => 'fundraiser',
        ]);

        $user = User::create([
            'name' => 'Zidhan Raffly',
            'email' => 'zidhanraffly@gmail.com',
            'avatar' => 'image/avatar.jpg',
            'password' => bcrypt('Zidhan041003'),
        ]);

        $user->assignRole($ownerRole);
    }
}

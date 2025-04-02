<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'owner'
        ]);

        $buyerRole = Role::create([
            'name' => 'buyer'
        ]);

        ///fabrikasi user awal
        $user1 = User::create([
            'name' => 'Salistia Putra',
            'email' => 'salis@gmail.com',
            'password' => bcrypt('asdasdasd')
        ]);
        $user1->assignRole($ownerRole);

        $user2 = User::create([
            'name' => 'Andi',
            'email' => 'andi@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $user2->assignRole($buyerRole);
    }
}

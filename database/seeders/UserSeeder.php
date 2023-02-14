<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = ['admin', 'reseller', 'customer'];

        foreach ($users as $user) {
            $role = Role::create([
                'name' => $user
            ]);

            $profile = User::query()
                ->create([
                    'id' => Uuid::uuid(),
                    'name' => $user,
                    'email' => $user . "@gmail.com",
                    'password' => bcrypt('password')
                ]);

            $profile->assignRole($role);
        }

    }
}

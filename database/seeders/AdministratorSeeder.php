<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Faker\Provider\Uuid;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'administrator'
        ]);

        $profile = User::query()
            ->create([
                'id' => Uuid::uuid(),
                'name' => 'administrator',
                'email' => "administrator@gmail.com",
                'password' => bcrypt('password'),
                'email_verified_at' => now()
            ]);

        $profile->assignRole($role);
    }
}

<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        $author = UserRoleEnum::AUTHOR->value;
        $role = Role::create([
            'name' => $author,
        ]);

        $profile = User::query()
            ->create([
                'id' => Uuid::uuid(),
                'name' => $author,
                'email' => $author . "@gmail.com",
                'password' => bcrypt('password'),
                'email_verified_at' => now()
            ]);

        $profile->assignRole($role);
    }
}

<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
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
        User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) {
                $user->assignRole(UserRoleEnum::ADMINISTRATOR->value);
            });
    }
}

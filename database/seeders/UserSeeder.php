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
        $users = ['admin', 'reseller', 'customer', 'author'];

        foreach ($users as $user) {
            $role = Role::create([
                'name' => $user
            ]);

            if ($user == 'reseller') {
                $code = strtolower(str_random(7));
            } else {
                $code = null;
            }

            $profile = User::query()
                ->create([
                    'id' => Uuid::uuid(),
                    'name' => $user,
                    'code_affiliate' => $code,
                    'email' => $user . "@gmail.com",
                    'password' => bcrypt('password'),
                    'email_verified_at' => now()
                ]);

            $profile->assignRole($role);
        }
    }
}

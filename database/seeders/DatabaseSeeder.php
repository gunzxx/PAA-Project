<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name'=>"admin"]);
        Role::create(['name'=>"visitor"]);

        $user = \App\Models\User::create([
            'name' => 'Gunzxx',
            'email' => 'gunzxx@mail.com',
            'password' => bcrypt('123'),
        ]);
        $user->assignRole('admin');

        $user = \App\Models\User::create([
            'name' => 'Gunz 3',
            'email' => 'gunz3@mail.com',
            'password' => bcrypt('123'),
        ]);
        $user->assignRole('visitor');
    }
}

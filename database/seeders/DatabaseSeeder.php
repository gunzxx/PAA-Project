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
            'address' => "Jl Kalimantan 40",
        ]);
        $user->assignRole('admin');

        $user = \App\Models\User::create([
            'name' => 'Gunz 3',
            'email' => 'gunz3@mail.com',
            'password' => bcrypt('123'),
            'address' => "Jl Kalimantan 43",
        ]);
        $user->assignRole('visitor');

        $user = \App\Models\User::create([
            'name' => 'M Bayu Dwi Praptama',
            'email' => 'bayu@mail.com',
            'password' => bcrypt('123'),
            'address' => "Jl Kalimantan 41",
        ]);
        $user->assignRole('admin');

        $user = \App\Models\User::create([
            'name' => 'Farhan Burhanuddin Syaifullah',
            'email' => 'farhan@mail.com',
            'password' => bcrypt('123'),
            'address' => "Jl Kalimantan 41",
        ]);
        $user->assignRole('admin');
    }
}

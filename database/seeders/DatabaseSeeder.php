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

        \App\Models\Category::create([
            'name' => 'Destinasi',
        ]);

        \App\Models\Category::create([
            'name' => 'Kuliner',
        ]);

        \App\Models\Tourist::create([
            'name' => 'Batu jubang',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nobis, labore quis esse asperiores placeat corrupti at soluta ab rerum!',
            'location' => 'Jl. Soekarno Hatta',
            'category_id'=>1,
        ]);

        \App\Models\Tourist::create([
            'name' => 'Masjid Raudhatul Mukhlisin',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nobis, labore quis esse asperiores placeat corrupti at soluta ab rerum!',
            'location' => 'Jl. Soekarno Hatta',
            'category_id'=>1,
            'thumb' => 'https://1.bp.blogspot.com/-GFbRmK2ZdTA/XYHqL1XcgqI/AAAAAAAARA4/BddW0_aqfhIWS6qWcDp1tpqEh8tr12HSQCLcBGAsYHQ/s1600/masjid%2Bjember_002.JPG',
        ]);

        \App\Models\Tourist::create([
            'name' => 'Mie Gacoan',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nobis, labore quis esse asperiores placeat corrupti at soluta ab rerum!',
            'location' => 'Jl. Soekarno Hatta',
            'category_id'=>2,
        ]);

        \App\Models\Tourist::create([
            'name' => 'Bu Sri',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nobis, labore quis esse asperiores placeat corrupti at soluta ab rerum!',
            'location' => 'Jl. Soekarno Hatta',
            'category_id'=>2,
        ]);

        \App\Models\Tourist::create([
            'name' => 'Kantin barokah',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nobis, labore quis esse asperiores placeat corrupti at soluta ab rerum!',
            'location' => 'Jl. Soekarno Hatta',
            'category_id'=>2,
        ]);

        \App\Models\Tourist::create([
            'name' => 'Pa Edi',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nobis, labore quis esse asperiores placeat corrupti at soluta ab rerum!',
            'location' => 'Jl. Soekarno Hatta',
            'category_id'=>2,
        ]);

        \App\Models\Tourist::create([
            'name' => 'Mumbul Garden',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nobis, labore quis esse asperiores placeat corrupti at soluta ab rerum!',
            'location' => 'Jl. Soekarno Hatta',
            'category_id' => 1,
        ]);

        \App\Models\Tourist::create([
            'name' => 'Jember Sport Garden',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nobis, labore quis esse asperiores placeat corrupti at soluta ab rerum!',
            'location' => 'Jl. Soekarno Hatta',
            'category_id' => 1,
        ]);
    }
}

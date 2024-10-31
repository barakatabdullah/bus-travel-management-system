<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Trip;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone'=>777777779,
            'password'=>Hash::make('password')
        ]);

        $user->assignRole('admin');


        $user1 =User::create([
            'name' => 'mohammed saleh',
            'email' => 'test1@example.com',
            'phone'=>777777778,
            'password'=>Hash::make('password')
        ]);
        $user1->assignRole('passenger');

        Bus::create([
            'deriver' => "Ali",
            'capacity' => 20,
        ]);

        Bus::create([
            'deriver' => "Nasser",
            'capacity' => 15,
        ]);


        Trip::create([
            'name' => "Sana'a & Aden",
            'active' => true,
            'time' => "2024-6-7",
            'bus_id' => 1
        ]);

        Trip::create([
            'name' => "Sana'a & Taiz",
            'active' => true,
            'time' => "2024-6-8",
            'bus_id' => 1
        ]);
        Trip::create([
            'name' => "Taiz & Ibb",
            'active' => true,
            'time' => "2024-8-7",
            'bus_id' => 2
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // When you're running the UserSeeder, it will automatically run factories in the UserFactory as well.
        // The only thing you have to do is change the count in the Seeder itself.
        // E.G.:The UserSeeder contains a ProfileImage Factory. You should check the ProfileImageSeeder
        // and change the amount to what you want.


        User::factory()->count(3)->create();


//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}

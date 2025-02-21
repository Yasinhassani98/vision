<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Level;
use App\Models\User;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        User::factory(20)->create();
        Level::factory(12)->create();
        Student::factory(100)->create();
        Grade::factory(100)->create();
        Comment::factory(100)->create();
        Payment::factory(100)->create();
        Schedule::factory(100)->create();
    }
}

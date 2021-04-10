<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Task;
use App\Models\Solution;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Teachers
        /*User::create([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'is_teacher' => '1',
        ]);*/
        User::create([
            'name' => 'Teacher_1',
            'email' => 'teacher1@gmail.com',
            'password' => Hash::make('123456789'),
            'is_teacher' => '1',
        ]);
        User::create([
            'name' => 'Teacher_2',
            'email' => 'teacher2@gmail.com',
            'password' => Hash::make('123456789'),
            'is_teacher' => '1',
        ]);
        User::create([
            'name' => 'Teacher_3',
            'email' => 'teacher3@gmail.com',
            'password' => Hash::make('123456789'),
            'is_teacher' => '1',
        ]);
        // Subjects 
        Subject::create([
            'id' => 'IK-INT001',
            'name' => 'Introduction to Data Science',
            'description' => 'This course is a part of the first semester of the computer science master program.',
            'teacher_id' => '1',
            'credits' => '5'
        ]);

        Subject::create([
            'id' => 'IK-MAC01',
            'name' => 'Machine Learning',
            'description' => 'This course is a part of the second semester of the computer science master program data science specialization.',
            'teacher_id' => '2',
            'credits' => '5',
        ]);

        Subject::create([
            'id' => 'IK-ADV01',
            'name' => 'Advanced Machine Learning',
            'description' => 'This course is a part of the third semester of the computer science master program data science specialization.',
            'teacher_id' => '3',
            'credits' => '5',
        ]);

        // Tasks 
        Task::create([
            'name' => 'Server Side Assignment',
            'description' => 'This is a task.',
            'subject_id' => 'IK-INT001',
            'points' => '60'
        ]);

        Task::create([
            'name' => 'Front Side Assignment',
            'description' => 'This is a task.',
            'subject_id' => 'IK-MAC01',
            'points' => '60',
        ]);

        Task::create([
            'name' => 'Homework 1',
            'description' => 'This is a task.',
            'subject_id' => 'IK-ADV01',
            'points' => '10',
        ]);
    }
}

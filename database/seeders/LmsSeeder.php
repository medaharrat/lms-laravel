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
        // Users
        User::create(
            [
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com' ,
            'password' => Hash::make('123456789'),
            'is_teacher' => '1',
            ],
            [
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com' ,
            'password' => Hash::make('123456789'),
            'is_teacher' => '1',
            ],
            [
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com' ,
            'password' => Hash::make('123456789'),
            'is_teacher' => '1',
            ],
            [
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com' ,
            'password' => Hash::make('123456789'),
            'is_teacher' => '0',
            ],
            [
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com' ,
            'password' => Hash::make('123456789'),
            'is_teacher' => '0',
            ],
            [
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com' ,
            'password' => Hash::make('123456789'),
            'is_teacher' => '0',
            ],
        );
        // Subjects 
        Subject::create(
            [
            'code' => 'IK-INT001',
            'name' => 'Introduction to Data Science',
            'description' => 'This course is a part of the first semester of the computer science master program.',
            'teacher_id' => '1',
            'credits' => '5'
            ],
            [
            'code' => 'IK-MAC01',
            'name' => 'Machine Learning',
            'description' => 'This course is a part of the second semester of the computer science master program data science specialization.',
            'teacher_id' => '2',
            'credits' => '5',
            ],
            [
            'code' => 'IK-ADV01',
            'name' => 'Advanced Machine Learning',
            'description' => 'This course is a part of the third semester of the computer science master program data science specialization.',
            'teacher_id' => '3',
            'credits' => '5',
            ]
        );
        /* Students Subjects
        DB::table('students_subjects')->create([
            'student_id' => '1',
            'subject_id' => 'IK-INT001',
        ]);
        DB::table('students_subjects')->create([
            'student_id' => '2',
            'subject_id' => 'IK-MAC01',
        ]);
        DB::table('students_subjects')->create([
            'student_id' => '3',
            'subject_id' => 'IK-ADV01',
        ]);*/
        // Tasks 
        Task::create(
        [
            'name' => 'Server Side Assignment',
            'description' => 'This is a task.',
            'subject_id' => '1',
            'points' => '60'
        ],
        [
            'name' => 'Front Side Assignment',
            'description' => 'This is a task.',
            'subject_id' => '2',
            'points' => '60',
        ],
        [
            'name' => 'Homework 1',
            'description' => 'This is a task.',
            'subject_id' => '3',
            'points' => '10',
        ]);

        // Solutions 
        Solution::create(
        [
            'student_id' => '4',
            'task_id' => '1.',
            'solution' => 'This is a solution 0'
        ],
        [
            'student_id' => '5',
            'task_id' => '1.',
            'solution' => 'This is a solution 1',
        ],
        [
            'student_id' => '6',
            'task_id' => '1.',
            'solution' => 'This is a solution 2',
        ]);
    }
}

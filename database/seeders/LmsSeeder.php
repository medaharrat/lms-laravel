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
        User::create([
            'name' => 'Student_1',
            'email' => 'student1@gmail.com',
            'password' => Hash::make('123456789'),
            'is_teacher' => '0',
        ]);
        User::create([
            'name' => 'Student_2',
            'email' => 'student2@gmail.com',
            'password' => Hash::make('123456789'),
            'is_teacher' => '0',
        ]);
        User::create([
            'name' => 'Student_3',
            'email' => 'student3@gmail.com',
            'password' => Hash::make('123456789'),
            'is_teacher' => '0',
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

        // Solutions 
        Solution::create([
            'student_id' => '4',
            'task_id' => '1.',
            'solution' => '# Program to display the Fibonacci sequence up to n-th term

                nterms = int(input("How many terms? "))

                # first two terms
                n1, n2 = 0, 1
                count = 0

                # check if the number of terms is valid
                if nterms <= 0:
                print("Please enter a positive integer")
                elif nterms == 1:
                print("Fibonacci sequence upto",nterms,":")
                print(n1)
                else:
                print("Fibonacci sequence:")
                while count < nterms:
                    print(n1)
                    nth = n1 + n2
                    # update values
                    n1 = n2
                    n2 = nth
                    count += 1',
            'evaluatedOn' => '2021-04-10 00:33:19',
            'points' => '10'
        ]);

        Solution::create([
            'student_id' => '5',
            'task_id' => '1.',
            'solution' => 'This is a solution 1',
        ]);

        Solution::create([
            'student_id' => '6',
            'task_id' => '1.',
            'solution' => 'This is a solution 2',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Task;
use App\Models\Solution;
use Illuminate\Database\Seeder;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Teachers CREATE A SEEDER FOR TEACHERS 


        // Subjects 
        Subject::create([
            'id' => 'IK-INT001',
            'name' => 'Introduction to Data Science',
            'description' => 'This course is a part of the first semester of the computer science master program.',
            'credits' => '5'
        ]);

        Subject::create([
            'id' => 'IK-MAC01',
            'name' => 'Machine Learning',
            'description' => 'This course is a part of the second semester of the computer science master program data science specialization.',
            'credits' => '5',
        ]);

        Subject::create([
            'id' => 'IK-ADV01',
            'name' => 'Advanced Machine Learning',
            'description' => 'This course is a part of the third semester of the computer science master program data science specialization.',
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

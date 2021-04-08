<?php

namespace Database\Seeders;

use App\Models\Subject;
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
            'code' => 'IK-INT001',
            'name' => 'Introduction to Data Science',
            'description' => 'This course is a part of the first semester of the computer science master program.',
            'credits' => '5'
        ]);

        Subject::create([
            'code' => 'IK-MAC01',
            'name' => 'Machine Learning',
            'description' => 'This course is a part of the second semester of the computer science master program data science specialization.',
            'credits' => '5',
        ]);

        Subject::create([
            'code' => 'IK-ADV01',
            'name' => 'Advanced Machine Learning',
            'description' => 'This course is a part of the third semester of the computer science master program data science specialization.',
            'credits' => '5',
        ]);
    }
}

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
        for($i = 1; $i <= 3; $i++){
            User::create([
                'name' => 'Teacher'.$i,
                'email' => 'teacher'.$i.'@gmail.com' ,
                'password' => Hash::make('123456789'),
                'is_teacher' => '1'
            ]);
        };

        for($i = 1; $i <= 3; $i++){
            User::create([
                'name' => 'Student'.$i,
                'email' => 'student'.$i.'@gmail.com' ,
                'password' => Hash::make('123456789'),
                'is_teacher' => '0'
            ]);
        };

        // Subjects 
        for($i = 1; $i <= 3; $i++){
            Subject::create([
                'code' => 'IK-SUB00'.$i,
                'name' => 'Machine Learning '.$i,
                'description' => 'This is a master course',
                'teacher_id' => $i,
                'credits' => '5'
            ]);
        }

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
        for($i = 1; $i <= 3; $i++){
            Task::create([
                'name' => 'Task '.$i,
                'description' => 'This is a task.',
                'subject_id' => $i,
                'points' => '60'
            ]);
        }

        // Solutions 
        for($i = 1; $i <= 3; $i++){
            Solution::create([
                'student_id' => $i,
                'task_id' => '1',
                'solution' => 'This is a solution '.$i
            ]);
        }
    }
}

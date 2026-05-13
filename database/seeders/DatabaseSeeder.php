<?php

namespace Database\Seeders;

use App\Models\AdvisorProfile;
use App\Models\Course;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'System Administrator',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Advisor
        $advisor = User::create([
            'name'     => 'Dr. Olawale Ibrahim',
            'email'    => 'advisor@advisor.com',
            'password' => Hash::make('password'),
            'role'     => 'advisor',
        ]);
        AdvisorProfile::create([
            'user_id'      => $advisor->id,
            'staff_id'     => 'STAFF/2026/001',
            'department'   => 'Computer Science',
            'faculty'      => 'Science & Technology',
            'phone'        => '08012345678',
            'bio'          => 'PhD in Computer Science. 10 years teaching experience.',
            'max_students' => 30,
        ]);

        // Student
        $student = User::create([
            'name'     => 'John Doe Eniola',
            'email'    => 'student@student.com',
            'password' => Hash::make('password'),
            'role'     => 'student',
        ]);
        StudentProfile::create([
            'user_id'       => $student->id,
            'matric_number' => 'P/ND/23/3210111',
            'department'    => 'Computer Science',
            'faculty'       => 'Science & Technology',
            'program'       => 'ND',
            'level'         => '100',
            'phone'         => '08098765432',
            'session'       => '2025/2026',
        ]);

        // Assign student to advisor
        $advisor->advisedStudents()->attach($student->id);

        // Sample courses
        $courses = [
            ['code' => 'CSC 101', 'title' => 'Introduction to Computing',      'credit_units' => 3, 'semester' => 'First',  'level' => '100', 'department' => 'Computer Science'],
            ['code' => 'CSC 102', 'title' => 'Computer Programming I',         'credit_units' => 3, 'semester' => 'First',  'level' => '100', 'department' => 'Computer Science'],
            ['code' => 'MTH 101', 'title' => 'Elementary Mathematics I',        'credit_units' => 3, 'semester' => 'First',  'level' => '100', 'department' => 'Computer Science'],
            ['code' => 'PHY 101', 'title' => 'General Physics I',               'credit_units' => 3, 'semester' => 'First',  'level' => '100', 'department' => 'Computer Science'],
            ['code' => 'GNS 101', 'title' => 'Use of English I',                'credit_units' => 2, 'semester' => 'First',  'level' => '100', 'department' => 'Computer Science'],
            ['code' => 'CSC 103', 'title' => 'Computer Programming II',         'credit_units' => 3, 'semester' => 'Second', 'level' => '100', 'department' => 'Computer Science'],
            ['code' => 'CSC 104', 'title' => 'Data Structures',                 'credit_units' => 3, 'semester' => 'Second', 'level' => '100', 'department' => 'Computer Science'],
            ['code' => 'MTH 102', 'title' => 'Elementary Mathematics II',       'credit_units' => 3, 'semester' => 'Second', 'level' => '100', 'department' => 'Computer Science'],
            ['code' => 'GNS 102', 'title' => 'Use of English II',               'credit_units' => 2, 'semester' => 'Second', 'level' => '100', 'department' => 'Computer Science'],
        ];

        foreach ($courses as $c) {
            Course::create(array_merge($c, ['is_compulsory' => true]));
        }
    }
}


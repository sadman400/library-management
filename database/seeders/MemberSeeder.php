<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'gender' => 'Male',
                'address' => '123 Main St, Anytown',
                'contact' => '555-123-4567',
                'type' => 'Student',
                'year_level' => 3,
                'status' => 'Active'
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Smith',
                'gender' => 'Female',
                'address' => '456 Oak Ave, Somewhere',
                'contact' => '555-987-6543',
                'type' => 'Student',
                'year_level' => 2,
                'status' => 'Active'
            ],
            [
                'firstname' => 'Robert',
                'lastname' => 'Johnson',
                'gender' => 'Male',
                'address' => '789 Pine Rd, Nowhere',
                'contact' => '555-456-7890',
                'type' => 'Faculty',
                'year_level' => 0,
                'status' => 'Active'
            ],
            [
                'firstname' => 'Emily',
                'lastname' => 'Williams',
                'gender' => 'Female',
                'address' => '321 Cedar Ln, Elsewhere',
                'contact' => '555-789-0123',
                'type' => 'Student',
                'year_level' => 4,
                'status' => 'Active'
            ],
            [
                'firstname' => 'Michael',
                'lastname' => 'Brown',
                'gender' => 'Male',
                'address' => '654 Maple Dr, Anywhere',
                'contact' => '555-321-6540',
                'type' => 'Faculty',
                'year_level' => 0,
                'status' => 'Active'
            ],
            [
                'firstname' => 'Sarah',
                'lastname' => 'Davis',
                'gender' => 'Female',
                'address' => '987 Birch St, Someplace',
                'contact' => '555-654-3210',
                'type' => 'Student',
                'year_level' => 1,
                'status' => 'Inactive'
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}

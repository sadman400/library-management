<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usertype;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usertypes = [
            ['borrowertype' => 'Student'],
            ['borrowertype' => 'Faculty'],
            ['borrowertype' => 'Staff'],
            ['borrowertype' => 'Researcher'],
            ['borrowertype' => 'Alumni'],
            ['borrowertype' => 'Guest']
        ];

        foreach ($usertypes as $usertype) {
            Usertype::create($usertype);
        }
    }
}

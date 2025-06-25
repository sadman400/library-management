<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BookIssuanceDetail;
use App\Models\Member;

class BookIssuanceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get member IDs to use for issuances
        $members = Member::pluck('member_id')->toArray();
        
        $issuances = [
            [
                'member_id' => $members[0], // John Doe
                'date_borrow' => now()->subDays(30),
                'due_date' => now()->subDays(16) // Already due
            ],
            [
                'member_id' => $members[1], // Jane Smith
                'date_borrow' => now()->subDays(20),
                'due_date' => now()->addDays(10) // Still has time
            ],
            [
                'member_id' => $members[2], // Robert Johnson
                'date_borrow' => now()->subDays(15),
                'due_date' => now()->addDays(15) // Still has time
            ],
            [
                'member_id' => $members[3], // Emily Williams
                'date_borrow' => now()->subDays(5),
                'due_date' => now()->addDays(25) // Still has time
            ],
        ];

        foreach ($issuances as $issuance) {
            BookIssuanceDetail::create($issuance);
        }
    }
}

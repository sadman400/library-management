<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BookReturnDetail;
use App\Models\Book;
use App\Models\BookIssuanceDetail;

class BookReturnDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get book IDs and issuance IDs to use for returns
        $books = Book::pluck('book_id')->toArray();
        $issuances = BookIssuanceDetail::pluck('borrow_id')->toArray();
        
        $returns = [
            [
                'book_id' => $books[0], // To Kill a Mockingbird
                'borrow_id' => $issuances[0], // John Doe's issuance
                'borrow_status' => 'Returned',
                'date_return' => now()->subDays(20) // Returned on time
            ],
            [
                'book_id' => $books[1], // The Great Gatsby
                'borrow_id' => $issuances[0], // John Doe's issuance
                'borrow_status' => 'Damaged',
                'date_return' => now()->subDays(18) // Returned on time but damaged
            ],
            [
                'book_id' => $books[2], // A Brief History of Time
                'borrow_id' => $issuances[1], // Jane Smith's issuance
                'borrow_status' => 'Returned',
                'date_return' => now()->subDays(5) // Returned early
            ],
        ];

        foreach ($returns as $return) {
            BookReturnDetail::create($return);
        }
        
        // Update book status for damaged book
        Book::where('book_id', $books[1])->update(['status' => 'Damaged']);
    }
}

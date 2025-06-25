<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category IDs to use for books
        $categories = Category::pluck('category_id')->toArray();
        
        $books = [
            [
                'book_title' => 'To Kill a Mockingbird',
                'category_id' => $categories[0], // Fiction
                'author' => 'Harper Lee',
                'book_copies' => 5,
                'book_pub' => 'HarperCollins',
                'publisher_name' => 'J. B. Lippincott & Co.',
                'ISBN' => '978-0-06-112008-4',
                'copyright_year' => '1960',
                'date_receiver' => now()->subMonths(6),
                'date_added' => now()->subMonths(6),
                'status' => 'Available'
            ],
            [
                'book_title' => 'The Great Gatsby',
                'category_id' => $categories[0], // Fiction
                'author' => 'F. Scott Fitzgerald',
                'book_copies' => 3,
                'book_pub' => 'Scribner',
                'publisher_name' => 'Charles Scribner\'s Sons',
                'ISBN' => '978-0-7432-7356-5',
                'copyright_year' => '1925',
                'date_receiver' => now()->subMonths(5),
                'date_added' => now()->subMonths(5),
                'status' => 'Available'
            ],
            [
                'book_title' => 'A Brief History of Time',
                'category_id' => $categories[2], // Science & Technology
                'author' => 'Stephen Hawking',
                'book_copies' => 2,
                'book_pub' => 'Bantam Books',
                'publisher_name' => 'Bantam Dell Publishing Group',
                'ISBN' => '978-0-553-10953-5',
                'copyright_year' => '1988',
                'date_receiver' => now()->subMonths(4),
                'date_added' => now()->subMonths(4),
                'status' => 'Available'
            ],
            [
                'book_title' => 'The Diary of a Young Girl',
                'category_id' => $categories[4], // Biography
                'author' => 'Anne Frank',
                'book_copies' => 4,
                'book_pub' => 'Contact Publishing',
                'publisher_name' => 'Contact Publishing',
                'ISBN' => '978-0-553-57712-9',
                'copyright_year' => '1947',
                'date_receiver' => now()->subMonths(3),
                'date_added' => now()->subMonths(3),
                'status' => 'Available'
            ],
            [
                'book_title' => 'The 7 Habits of Highly Effective People',
                'category_id' => $categories[6], // Self-Help
                'author' => 'Stephen R. Covey',
                'book_copies' => 3,
                'book_pub' => 'Free Press',
                'publisher_name' => 'Free Press',
                'ISBN' => '978-0-7432-6951-3',
                'copyright_year' => '1989',
                'date_receiver' => now()->subMonths(2),
                'date_added' => now()->subMonths(2),
                'status' => 'Available'
            ],
            [
                'book_title' => 'World War II: A Complete History',
                'category_id' => $categories[3], // History
                'author' => 'Martin Gilbert',
                'book_copies' => 2,
                'book_pub' => 'Henry Holt and Company',
                'publisher_name' => 'Henry Holt and Company',
                'ISBN' => '978-0-8050-7623-3',
                'copyright_year' => '2004',
                'date_receiver' => now()->subMonths(1),
                'date_added' => now()->subMonths(1),
                'status' => 'Available'
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}

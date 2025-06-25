<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\Category;
use App\Models\BookIssuanceDetail;
use App\Models\BookReturnDetail;
use Illuminate\Support\Facades\DB;
use DateTime;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for dashboard stats
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $totalCategories = Category::count();
        $borrowedBooks = Book::where('status', 'Borrowed')->count();
        $availableBooks = Book::where('status', 'Available')->count();
        $damagedBooks = Book::where('status', 'Damaged')->count();
        $activeMembers = Member::where('status', 'Active')->count();
        
        // Calculate overdue books
        $today = new DateTime();
        // Get all book issuances with due dates in the past
        $overdueBooks = BookIssuanceDetail::where('due_date', '<', $today->format('Y-m-d'))
            ->count();
        
        // Get recent book issuances with member information
        $recentIssuances = BookIssuanceDetail::with('member')
            ->orderBy('date_borrow', 'desc')
            ->limit(5)
            ->get();
            
        // Add placeholder book information for display
        foreach ($recentIssuances as $issuance) {
            // Create a virtual book object since we don't have a direct relationship
            $issuance->book = (object)[
                'book_title' => 'Book #' . $issuance->borrow_id
            ];
        }
        
        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'totalCategories',
            'borrowedBooks',
            'availableBooks',
            'damagedBooks',
            'activeMembers',
            'overdueBooks',
            'recentIssuances'
        ));
    }
}

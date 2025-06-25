<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'author' => 'required|string|max:255',
            'book_copies' => 'required|integer|min:1',
            'book_pub' => 'required|string|max:255',
            'publisher_name' => 'required|string|max:255',
            'ISBN' => 'required|string|max:20|unique:books',
            'copyright_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'date_receiver' => 'required|date',
            'date_added' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Book::create($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('category')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'book_title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'author' => 'required|string|max:255',
            'book_copies' => 'required|integer|min:1',
            'book_pub' => 'required|string|max:255',
            'publisher_name' => 'required|string|max:255',
            'ISBN' => 'required|string|max:20|unique:books,ISBN,' . $id . ',book_id',
            'copyright_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'date_receiver' => 'required|date',
            'date_added' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        
        // Check if book has return details
        if ($book->bookReturnDetails()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete book because it has associated return records.');
        }
        
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}

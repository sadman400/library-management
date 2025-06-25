<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookIssuanceDetail;
use App\Models\BookReturnDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookReturnDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returns = BookReturnDetail::with(['book', 'bookIssuanceDetail.member'])->get();
        return view('book-returns.index', compact('returns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('status', 'Available')->get();
        $issuances = BookIssuanceDetail::with('member')->get();
        return view('book-returns.create', compact('books', 'issuances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,book_id',
            'borrow_id' => 'required|exists:bookissuancedetails,borrow_id',
            'borrow_status' => 'required|string|max:50',
            'date_return' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        BookReturnDetail::create($request->all());

        // Update book status if needed
        if ($request->borrow_status === 'Returned') {
            $book = Book::find($request->book_id);
            $book->update(['status' => 'Available']);
        }

        return redirect()->route('book-returns.index')
            ->with('success', 'Book return record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $return = BookReturnDetail::with(['book', 'bookIssuanceDetail.member'])->findOrFail($id);
        return view('book-returns.show', compact('return'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $return = BookReturnDetail::findOrFail($id);
        $books = Book::all();
        $issuances = BookIssuanceDetail::with('member')->get();
        return view('book-returns.edit', compact('return', 'books', 'issuances'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $return = BookReturnDetail::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,book_id',
            'borrow_id' => 'required|exists:bookissuancedetails,borrow_id',
            'borrow_status' => 'required|string|max:50',
            'date_return' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $oldStatus = $return->borrow_status;
        $return->update($request->all());

        // Update book status if status changed
        if ($oldStatus !== $request->borrow_status) {
            $book = Book::find($request->book_id);
            if ($request->borrow_status === 'Returned') {
                $book->update(['status' => 'Available']);
            } else {
                $book->update(['status' => 'Borrowed']);
            }
        }

        return redirect()->route('book-returns.index')
            ->with('success', 'Book return record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $return = BookReturnDetail::findOrFail($id);
        $return->delete();

        return redirect()->route('book-returns.index')
            ->with('success', 'Book return record deleted successfully.');
    }
}

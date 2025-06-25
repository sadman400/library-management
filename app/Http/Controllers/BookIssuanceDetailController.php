<?php

namespace App\Http\Controllers;

use App\Models\BookIssuanceDetail;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookIssuanceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issuances = BookIssuanceDetail::with('member')->get();
        return view('book-issuances.index', compact('issuances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::where('status', 'Active')->get();
        return view('book-issuances.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required|exists:members,member_id',
            'date_borrow' => 'required|date',
            'due_date' => 'required|date|after_or_equal:date_borrow',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        BookIssuanceDetail::create($request->all());

        return redirect()->route('book-issuances.index')
            ->with('success', 'Book issuance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $issuance = BookIssuanceDetail::with(['member', 'bookReturnDetails.book'])->findOrFail($id);
        return view('book-issuances.show', compact('issuance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $issuance = BookIssuanceDetail::findOrFail($id);
        $members = Member::where('status', 'Active')->get();
        return view('book-issuances.edit', compact('issuance', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $issuance = BookIssuanceDetail::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'member_id' => 'required|exists:members,member_id',
            'date_borrow' => 'required|date',
            'due_date' => 'required|date|after_or_equal:date_borrow',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $issuance->update($request->all());

        return redirect()->route('book-issuances.index')
            ->with('success', 'Book issuance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $issuance = BookIssuanceDetail::findOrFail($id);
        
        // Check if issuance has return details
        if ($issuance->bookReturnDetails()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete book issuance because it has associated return records.');
        }
        
        $issuance->delete();

        return redirect()->route('book-issuances.index')
            ->with('success', 'Book issuance deleted successfully.');
    }
}

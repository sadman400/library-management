<?php

namespace App\Http\Controllers;

use App\Models\Usertype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usertypes = Usertype::all();
        return view('usertypes.index', compact('usertypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'borrowertype' => 'required|string|max:255|unique:usertypes',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Usertype::create([
            'borrowertype' => $request->borrowertype,
        ]);

        return redirect()->route('usertypes.index')
            ->with('success', 'User type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usertype = Usertype::findOrFail($id);
        return view('usertypes.show', compact('usertype'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usertype = Usertype::findOrFail($id);
        return view('usertypes.edit', compact('usertype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usertype = Usertype::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'borrowertype' => 'required|string|max:255|unique:usertypes,borrowertype,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $usertype->update([
            'borrowertype' => $request->borrowertype,
        ]);

        return redirect()->route('usertypes.index')
            ->with('success', 'User type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usertype = Usertype::findOrFail($id);
        $usertype->delete();

        return redirect()->route('usertypes.index')
            ->with('success', 'User type deleted successfully.');
    }
}

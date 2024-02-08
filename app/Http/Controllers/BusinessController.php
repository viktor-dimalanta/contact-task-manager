<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $businesses = Business::all();
        return view('businesses.index', compact('businesses'));
    }

    public function create()
    {
        return view('businesses.create');
    }

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'name' => 'required',
            // Add validation rules for other fields
        ]);

        // Create business
        Business::create($validatedData);

        return redirect()->route('businesses.index')->with('success', 'Business created successfully.');
    }

    public function edit(Business $business)
    {
        return view('businesses.edit', compact('business'));
    }

    public function update(Request $request, Business $business)
    {
        // Validation
        $validatedData = $request->validate([
            'name' => 'required',
            // Add validation rules for other fields
        ]);

        // Update business
        $business->update($validatedData);

        return redirect()->route('businesses.index')->with('success', 'Business updated successfully.');
    }

    public function destroy(Business $business)
    {
        // Delete business
        $business->delete();

        return redirect()->route('businesses.index')->with('success', 'Business deleted successfully.');
    }
}
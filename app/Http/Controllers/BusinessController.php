<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $businesses = Business::orderBy('created_at', 'desc')->paginate(10);
        return view('businesses.index', compact('businesses'));
    }

    public function create()
    {
        $tags = Tag::orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('businesses.create', compact(['tags','categories']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|unique:people|max:255',
            'categories' => 'array',
            'tags' => 'array',
        ]);

        $business = new Business();
        $business->business_name = $request->business_name;
        $business->email = $request->email;
        $business->categories = json_encode($request->categories);
        $business->tags = json_encode($request->tags);
        $business->save();

        return redirect()->route('businesses.index')->with('success', 'Business created successfully.');
    }

    public function edit(Business $business)
    {
        $tags = Tag::orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        
        return view('businesses.edit', compact(['business','tags','categories']));
    }

    public function update(Request $request, Business $business)
    {
        // Validation
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required',
            'categories' => 'array',
            'tags' => 'array',
        ]);

        // Update business
        $business->update($validatedData);

        return redirect()->route('businesses.index')->with('success', 'Business updated successfully.');
    }

    public function show($id)
    {
        $business = Business::findOrFail($id); // Assuming your Business model is named Business
        $tasks = $business->tasks;

        return view('businesses.show', compact(['business','tasks']));
    }

    public function destroy(Business $business)
    {
        // Delete business
        $business->delete();

        return redirect()->route('businesses.index')->with('success', 'Business deleted successfully.');
    }
}
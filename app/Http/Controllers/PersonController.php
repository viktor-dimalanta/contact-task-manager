<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Person;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $people = Person::orderBy('created_at', 'desc')->paginate(10);
        return view('people.index', compact('people'));
    }

    public function create()
    {
        $tags = Tag::orderBy('created_at', 'desc')->get();
        $businesses = Business::orderBy('created_at', 'desc')->get();
        return view('people.create', compact(['businesses','tags']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:people|max:255',
            'phone' => 'required|string|max:20',
            'business' => 'required|string',
            'tags' => 'array',
        ]);

        $person = new Person();
        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->email = $request->email;
        $person->phone = $request->phone;
        $person->business = $request->business;
        $person->tags = json_encode($request->tags);
        $person->save();

        return redirect()->route('people.index')->with('success', 'Person created successfully.');
    }

    public function edit(Person $person)
    {
        $tags = Tag::orderBy('created_at', 'desc')->get();
        $all_person = Person::with('business')->get();
        return view('people.edit', compact(['person','all_person','tags']));
    }

    public function update(Request $request, Person $person)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required',
            'phone' => 'required|string|max:20',
            'business' => 'required|string',
            'tags' => 'array',
        ]);

        if (isset($validatedData['tags'])) {
            $validatedData['tags'] = json_encode($validatedData['tags']);
        }
        
        $person->update($validatedData);

        return redirect()->route('people.index')->with('success', 'Person updated successfully.');
    }

    public function show($id)
    {
        $person = Person::findOrFail($id); 
        $tasks = $person->tasks;
        return view('people.show', compact(['person','tasks']));
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('people.index')->with('success', 'Person deleted successfully.');
    }
}

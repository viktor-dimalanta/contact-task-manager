<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Person;
use App\Models\Tag;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $people = Person::paginate(10);
        return view('people.index', compact('people'));
    }

    public function create()
    {
        $tags = Tag::paginate(10);
        $businesses = Business::paginate(10);
        return view('people.create', compact(['businesses','tags']));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // Add validation rules for other fields
        ]);

        Person::create($validatedData);

        return redirect()->route('people.index')->with('success', 'Person created successfully.');
    }

    public function edit(Person $person)
    {
        $tags = Tag::paginate(10);
        $all_person = Person::with('business')->get();
        return view('people.edit', compact(['person','all_person','tags']));
    }

    public function update(Request $request, Person $person)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // Add validation rules for other fields
        ]);

        $person->update($validatedData);

        return redirect()->route('people.index')->with('success', 'Person updated successfully.');
    }

    public function show($id)
    {
        $person = Person::findOrFail($id); 
        return view('people.show', compact('person'));
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('people.index')->with('success', 'Person deleted successfully.');
    }
}

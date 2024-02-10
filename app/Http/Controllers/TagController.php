<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->paginate(10);
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|string|max:255',
        ]);

        $tag = new Tag();
        $tag->tag_name = $request->tag_name;
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags|max:255',
            // Add validation rules for other fields
        ]);

        $tag->update($validatedData);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\KeychainPassword;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:50',
        ]);

        Category::create($validated);
        return redirect()->route('categories.index')->with('success', '"Categorie succesvol aangemaakt');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:50',
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Categorie succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //check if the category has associated keychain passwords
        $KeychainPasswords = KeychainPassword::where('category_id', $category->id)->get();
        if ($KeychainPasswords->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Categorie kan niet worden verwijderd omdat er nog wachtwoorden aan zijn gekoppeld');
        } else {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Categorie succesvol verwijderd');
        }
    }
}

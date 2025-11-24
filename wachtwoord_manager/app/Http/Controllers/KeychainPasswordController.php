<?php

namespace App\Http\Controllers;

use App\Models\KeychainPassword;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rules\Password;

class KeychainPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->input('category_id');
        if ($categoryId != null) {
            $keychainPasswords = KeychainPassword::where('category_id', $categoryId)->with('category')->get();
            $selected_category = Category::find($categoryId);
        } else {
            $keychainPasswords = KeychainPassword::with('category')->get();
            $selected_category = null;
        }

        foreach ($keychainPasswords as $keychainPassword) {
            $keychainPassword->password = decrypt($keychainPassword->password);
        }

        return view('keychainPasswords.index', compact('categories', 'keychainPasswords', 'selected_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('keychainPasswords.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'password' => [
                'required', 'string', 'max:50',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'username' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'refresh_interval' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['password'] = encrypt($validated['password']);

        KeychainPassword::create($validated);
        return redirect()->route('keychainPasswords.index')->with('success', 'Wachtwoord succesvol aangemaakt');
    }

    /**
     * Display the specified resource.
     */
    public function show(KeychainPassword $keychainPassword)
    {
        return view('keychainPasswords.show', compact('keychainPassword'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KeychainPassword $keychainPassword)
    {
        $categories = Category::all();
        $keychainPassword->password = decrypt($keychainPassword->password);
        return view('keychainPasswords.edit', compact('keychainPassword', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KeychainPassword $keychainPassword)
    {
        $validated = $request->validate([
            'password' => [
                'required', 'string', 'max:50',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'username' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'refresh_interval' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['password'] = encrypt($validated['password']);

        $keychainPassword->update($validated);
        return redirect()->route('keychainPasswords.index')->with('success', 'Wachtwoord succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KeychainPassword $keychainPassword)
    {
        $keychainPassword->delete();
        return redirect()->route('keychainPasswords.index')->with('success', 'Wachtwoord succesvol verwijderd');
    }
}

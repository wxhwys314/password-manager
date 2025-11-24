@extends('layouts.app')

@section('content')
    <div class="w-75 mx-auto">
        <h1>Nieuwe Wachtwoord Toevoegen</h1>
        <form action="{{ route('keychainPasswords.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Wachtwoord</label>
                <input type="text" name="password" class="form-control" minlength="8" maxlength="50" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Gebruikersnaam</label>
                <input type="text" name="username" class="form-control" maxlength="100" required>
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">URL</label>
                <input type="text" name="url" class="form-control" maxlength="255" required>
                @error('url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Opmerkingen</label>
                <textarea name="notes" class="form-control" rows="3"></textarea>
                @error('notes')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Verversingsfrequentie (week)</label>
                <input type="number" name="refresh_interval" class="form-control" min="0" step="1" value="0" required>
                @error('refresh_interval')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Categorie</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Opslaan</button>
            </div>
        </form>
    </div>
@endsection
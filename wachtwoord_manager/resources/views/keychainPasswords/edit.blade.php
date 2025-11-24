@extends('layouts.app')

@section('content')
    <div class="w-75 mx-auto">
        <h1>Wachtwoord Bewerken</h1>
        <form method="post" action="{{ route('keychainPasswords.update', $keychainPassword->id) }}">
            @csrf
            @method('PATCH')
            
            <div class="mb-3">
                <label class="form-label">Wachtwoord</label>
                <input type="text" class="form-control" name="password" value="{{ old('password', $keychainPassword->password) }}" minlength="8" maxlength="50" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Gebruikersnaam</label>
                <input type="text" class="form-control" name="username" value="{{ old('username', $keychainPassword->username) }}" maxlength="100" required>
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">URL</label>
                <input type="text" class="form-control" name="url" value="{{ old('url', $keychainPassword->url) }}" maxlength="255" required>
                @error('url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Opmerkingen</label>
                <textarea name="notes" class="form-control" rows="3">{{ old('notes', $keychainPassword->notes) }}</textarea>
                @error('notes')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Verversingsfrequentie (week)</label>
                <input type="number" class="form-control" name="refresh_interval" value="{{ old('refresh_interval', $keychainPassword->refresh_interval) }}" step="1" min="0" required>
                @error('refresh_interval')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Categorie</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            @selected(old('category_id', $keychainPassword->category_id) == $category->id)>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Wijzigen</button>
        </form>
    </div>
@endsection
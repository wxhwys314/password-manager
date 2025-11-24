@extends('layouts.app')

@section('content')
    <div class="w-75 mx-auto">
        <h1>Nieuwe Categorie Toevoegen</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Categorie Naam</label>
                <input type="text" name="category_name" class="form-control" maxlength="50" required>
                @error('category_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Opslaan</button>
        </form>
    </div>
@endsection
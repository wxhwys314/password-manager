@extends('layouts.app')

@section('content')
    <div class="w-75 mx-auto">
        <h1>Category Bewerken</h1>
        <form method="post" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="form-label">Categorie Naam</label>
                <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}" maxlength="50" required/>
                @error('category_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Wijzigen</button>
        </form>
    </div>
@endsection
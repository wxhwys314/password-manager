@extends('layouts.app')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger fade show" role="alert" id="message_alert">
            {{ session('error') }}
        </div>
    @endif
    <h1 class="mb-4">Categorieën</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Nieuwe Categorie</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Categorie Naam</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->category_name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm">Bewerken</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('message_alert');
        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show');
            }, 5000);
        }
    });
</script>
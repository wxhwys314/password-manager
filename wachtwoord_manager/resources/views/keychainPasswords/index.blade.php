@extends('layouts.app')

@section('content')
    <div class="main_content">
        <div class="side_nav">
            <button class="close_side_nav_button" onclick="closeSideNav()">x</button>
            <div class="category">
                <h4>
                    <a href="{{ route('keychainPasswords.index') }}">Alle Wachtwoorden</a>
                </h4>
            </div>
            @foreach ($categories as $category)
                <div class="category">
                    <h4>
                        <a href="{{ route('keychainPasswords.index', ['category_id' => $category->id]) }}">{{ $category->category_name }}</a>
                    </h4>
                </div>
            @endforeach
        </div>
        <div class="password_list">
            <div class="alert alert-success fade" role="alert" id="message_alert">
                Wachtwoord succesvol gekopieerd naar het klembord!
            </div>
            <h1 class="mb-4">
                @if ($selected_category == null)
                    Alle Wachtwoorden
                @else
                    {{ $selected_category->category_name }}
                @endif
                <button class="btn btn-primary mb-3 open_side_nav_button" onclick="openSideNav()">Category</button>
            </h1>
            <a href="{{ route('keychainPasswords.create') }}" class="btn btn-primary mb-3">Nieuwe Wachtwoord</a>
            
            <div style="width: 100% !important; overflow: auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Wachtwoord</th>
                            <th>Gebruikersnaam</th>
                            <th>Url</th>
                            <th>Opmerking</th>
                            <th>Verversingsfrequentie</th>
                            <th>Catgory</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keychainPasswords as $keychainPassword)
                            <tr>
                                <td>
                                    <div class="hidden hidden_{{ $keychainPassword->id }}" onclick="showPassword('{{ $keychainPassword->id }}')">************</div>
                                    <div class="password password_{{ $keychainPassword->id }}" onclick="hidePassword('{{ $keychainPassword->id }}')">{{ $keychainPassword->password }}</div>
                                </td>
                                <td>{{ $keychainPassword->username }}</td>
                                <td>{{ $keychainPassword->url }}</td>
                                <td>{{ $keychainPassword->notes }}</td>
                                @php
                                    $weekToDay = $keychainPassword->refresh_interval * 7;
                                    $dateOffset = "+$weekToDay days";
                                    $nextPasswordChangeDate = $keychainPassword->updated_at->modify($dateOffset)->format('Y-m-d');
                                @endphp
                                <td @if ($keychainPassword->refresh_interval != 0)
                                    title="Na {{ $nextPasswordChangeDate }} moet deze wachtwoord wijzigen"
                                @endif>
                                    @if ($keychainPassword->refresh_interval == 0)
                                        Nooit
                                    @else
                                        @if (new DateTime() < new DateTime($nextPasswordChangeDate))
                                            {{ $keychainPassword->refresh_interval }} week{{ $keychainPassword->refresh_interval > 1 ? 'en' : '' }}
                                        @else
                                            <span class="text-danger">Moet wijzigen</span>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $keychainPassword->category->category_name }}</td>
                                <td>
                                    <button class="btn btn-sm" onclick="copyPassword('{{ $keychainPassword->password }}')">Copy Wachtwoord</button>
                                    <a href="{{ route('keychainPasswords.edit', $keychainPassword) }}" class="btn btn-sm">Bewerken</a>
                                    <form action="{{ route('keychainPasswords.destroy', $keychainPassword) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script>
    var categoryId = new URLSearchParams(window.location.search).get('category_id') || 0;
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementsByClassName('category')[categoryId].classList.add('active');
    });

    function openSideNav() {
        document.querySelector('.side_nav').style.display = 'block';
        document.querySelector('.open_side_nav_button').style.display = 'none';
    }
    function closeSideNav() {
        document.querySelector('.side_nav').style.display = 'none';
        document.querySelector('.open_side_nav_button').style.display = 'block';
    }

    function showPassword(id) {
        document.querySelector('.hidden_' + id).style.display = 'none';
        document.querySelector('.password_' + id).style.display = 'block';
    }

    function hidePassword(id) {
        document.querySelector('.hidden_' + id).style.display = 'flex';
        document.querySelector('.password_' + id).style.display = 'none';
    }

    function copyPassword(password) {
        navigator.clipboard.writeText(password).then(() => {
            let alertBox = document.getElementById("message_alert");
            alertBox.classList.add("show");
            setTimeout(() => {
                alertBox.classList.remove("show");
            }, 3000);
        })
    }
</script>
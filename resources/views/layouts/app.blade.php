<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }}</title>



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    @livewireStyles
    @yield('styles.css')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('/home') }}">CRUD APP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if (Route::currentRouteName() != '/home')
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('post.index') }}">{{ __('titles.post') }}</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('livewire.index') }}">{{ __('titles.livewire_crud') }}</a>
                    </li>

                </ul>
            </div>
        @endif

    </nav>

    @if (Route::currentRouteName() == '/home')
        <div class="jumbotron">
            <h1 class="display-4">Welcome to CRUD APP</h1>
            <p class="lead">This is a simple CRUD application built with Laravel 8.</p>
            <hr class="my-4">
            <p>It uses the MVC design pattern and the Eloquent ORM.</p>
            <div class="row col-lg-12">
                <div class="col-lg-3">
                    <div class="card">
                        <a type="button" class="btn btn-outline-primary"
                            href="{{ route('post.index') }}">{{ __('titles.ajax_Crud_post') }}</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <a type="button" class="btn btn-outline-secondary"
                            style="color: #ED64A6;">{{ __('titles.livewire_crud') }}</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <a type="button" class="btn btn-outline-info">Info</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @yield('content')

    @yield('modal')


    @livewireScripts

    @yield('scripts.js')

</body>

</html>

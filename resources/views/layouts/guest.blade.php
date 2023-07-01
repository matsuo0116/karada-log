<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'カラダログ') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="/css/reset.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Scripts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@500&family=Noto+Sans+JP:wght@300;600&family=Noto+Serif&display=swap" rel="stylesheet">
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body id="guest" class="font-sans text-gray-900 antialiased ">
    <header class="header">
        <h1><a href="{{ route('index') }}"><img src="/storage/uploads/header_logo.svg" alt="カラダログ"></a></a></h1>
        @guest
        <div class="login_link"><a href="{{ route('login') }}">ログインする</a></div>
        @endguest
        @auth
        <p>ようこそ、{{ Auth::user()->name }}さん</p>
        @endauth
        @auth 
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button>ログアウト</button>
    </form>
    @endauth
    </header>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <!-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> -->

            <div class="login_form w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

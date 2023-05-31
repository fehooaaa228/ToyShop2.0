<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                <div style="width: 100%; height:100px;"></div>
                <div class="container m-6 bg-white p-4 gb-2">
                <p class="text-muted mb-2"><a href="{{url('home')}}">Главная</a>/<u>Корзина</u></p>
                @if($goods != [])
                    @foreach($goods as $good)
                        <div class="shadow p-6 my-4">
                            <div class="flex justify-between">
                                <div><img class="h-20" src="{{explode(' ', $good->img)[0]}}"></div>
                                <div class="flex">
                                    <div class="mx-5 flex align-items-center">
                                        <span>
                                            <p class="h4">{{$good->name}}</p>
                                            <p>{{$good->price}}₽</p>
                                        </span>
                                    </div>
                                    <div class="flex align-items-center">
                                        <a class="text-danger" href="http://127.0.0.1:8000/api/delete_from_basket?id={{$good->id}}">Удалить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="w-100 flex justify-content-end p-3">
                        <div><p class="h3">Итого: {{$price}}₽</p></div>
                    </div>
                @else
                    <div class="my-5 pb-5 px-5">
                        <p class="h3">У вас в корзине пока нет товаров</p>
                    </div>
                @endif
                </div>
            </main>

            <div class="w-100 h-20 bg-dark" style="margin-top: 100px; height: 550px;">

            </div>
        </div>
    </body>
</html>

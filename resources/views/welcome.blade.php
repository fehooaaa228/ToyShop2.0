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
        <style>
            p {
                text-decoration: none;
                color: black;
            }

            .goods:hover{
                background-color: rgba(0, 0, 0, 0.02);
                display: block;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                <div style="width: 100%; height:100px;"></div>
                <div class="container bg-white py-3 px-6 mb-5 rounded">
                    <p class="text-muted"><u>Главная</u></p>
                    <div class="row">
                        @foreach($goods as $i)
                            <div class="col-sm-4 my-3">
                                <a href="/home/goods/{{$i->id}}">
                                    <div class="goods border rounded-3 p-3">
                                        <img class="mb-3" src="{{explode(' ', $i->img)[0]}}">
                                        <p class="h1">{{$i->name}}</p>
                                        <p class="h3">{{$i->price}}₽</p>
                                        @auth
                                            @hasrole('admin')
                                                <a href="/api/delete_goods?id={{$i->id}}" class="btn btn-danger position-relative">Удалить</a>
                                            @endhasrole
                                        @endauth
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </main>

            <div class="container flex justify-center mb-6">

                {{$goods->links()}}

            </div>

            <div class="w-100 bg-dark" style="margin-top: 100px; height: 150px;">

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>

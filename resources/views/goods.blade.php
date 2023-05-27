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
                    @auth
                        <p class="text-muted mb-2"><a href="{{url('home')}}">Главная</a>/<u>{{$goods->name}}</u></p>
                        @else
                            <p class="text-muted mb-2"><a href="{{url('/')}}">Главная</a>/<u>{{$goods->name}}</u></p>
                    @endauth
                    <div class="flex mb-4">
                        <div>
                            <img style="max-width: 600px;" class="thumbnail" src="../../{{$goods->img}}">
                        </div>
                        <div class="p-6 mx-3">
                            <p class="h1">{{$goods->name}}</p>
                            <p class="h3">{{$goods->price}}₽</p>

                            @auth 
                                @if($basket == null)
                                    <a href="http://127.0.0.1:8000/api/add_to_busket?user={{Auth::user()->id}}&goods={{$goods->id}}" class="btn btn-primary my-3 p-3"><p class="h5 m-0">В корзину</p></a>
                                    @else 
                                        <div class="btn btn-primary my-3 p-3 disabled"><p class="h5 m-0">В корзине</p></div>
                                @endif 
                            @endauth
                        </div>
                    </div>

                    <hr>

                    <p class="h2 my-4">Отзывы</p>

                    @auth
                        <form method="POST" action="http://127.0.0.1:8000/api/add_review?name={{$name}}&id={{$goods->id}}&">
                            <div class="input-group mb-3">

                                <textarea class="form-control" placeholder="Оставьте свой отзыв" name="text"></textarea>
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Отправить</button>
                            </div>
                        </form>
                        @else 
                            <p class="h4 my-3">Зарегистрируйтесь или войдите чтобы оставлять отзывы</p>  
                    @endauth

                    @foreach($reviews as $review)
                        <div class="py-6 px-2 my-4">
                            <p class="h4">{{$review->sender}} <span class="text-muted fs-6 fw-light mx-3">{{$review->created_at}}</span></p>
                            {{$review->text}}
                        </div>
                    @endforeach
                </div>
            </main>

            <div class="w-100 h-20 bg-dark" style="margin-top: 100px; height: 130px;">

            </div>
        </div>
    </body>
</html>

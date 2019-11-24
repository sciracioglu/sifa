<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Şifa</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">
        <link href="css/tailwind.css" rel="stylesheet">
        <script src="js/app.js"></script>
	</head>
    <body class="bg-gray-100">
		<div class="container mx-auto" id='app'>
			<header class="flex items-center justify-between mb-10 text-3xl text-teal-400 px-4 py-4 bg-teal-900 ">
				<div class="flex items-center">
					<svg class='h-6 w-6 fill-current' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
						<path d="M10 3.22l-.61-.6a5.5 5.5 0 0 0-7.78 7.77L10 18.78l8.39-8.4a5.5 5.5 0 0 0-7.78-7.77l-.61.61z"/>
					</svg>
					<span class='ml-2'>Şifa</span>
				</div>
				<div>
					<svg @click='ekle=1' role="button" v-if='ekle && ekle == 0' class="h-6 w-6 fill-current focus:text-white hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
						<title>Ekle</title>
						<path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
					</svg>
					<svg v-if='ekle && ekle == 1' @click='vazgec()' role="button" class="h-6 w-6 fill-current focus:text-white hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
						<title>Vazgec</title>
						<path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"/>
					</svg>
				</div>
				@guest
                    <a class="text-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="text-sm" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                <div class="relative">
                    <button class="relative z-10 text-sm" @click='isOpen = !isOpen'>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </button>
                    <button @click='isOpen=false' tabindex="-1" v-if='isOpen' class="fixed w-full h-full inset-0 bg-black opacity-50 cursor-default"></button>
                    <div v-if='isOpen' class="absolute right-0 w-48 py-2 bg-white rounded-lg shadow text-sm">
                        <a class="block px-4 py-2 text-gray-800 hover:bg-teal-600 hover:text-white" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                @endguest
            </header>
            <div class="w-full max-w-xs">
                    <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            @csrf
                        <h3>{{ __('Login') }}</h3>
                      <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                          E-posta
                        </label>
                        <input name='email' class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="E-posta" type="email" placeholder="E-posta">
                      </div>
                      <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                          Sifre
                        </label>
                        <input name='password' class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                      </div>
                      <div class="flex items-center justify-between">
                        <button class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                          Giris
                        </button>
                        
                      </div>
                    </form>
                </div>
        </div>
        <script>
            var vue = new Vue({
                el:'#app',
                data:{
                    ekle:null,
                },
            });
        </script>
    </body>
</html>

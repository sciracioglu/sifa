<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Şifa</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">
        <link href="css/tailwind.css" rel="stylesheet">
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
				<nav>
					<svg @click='ekle=1' role="button" v-if='ekle == 0' class="h-6 w-6 fill-current focus:text-white hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
						<title>Ekle</title>
						<path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
					</svg>
					<svg v-else @click='vazgec()' role="button" class="h-6 w-6 fill-current focus:text-white hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
						<title>Vazgec</title>
						<path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"/>
					</svg>
					
				</nav>
				@guest
					<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					@if (Route::has('register'))
						<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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
			<div v-if='ekle === 0' class='w-full'>
				<div class="relative flex-1 max-w-sm w-full mb-6">
					<div class="absolute inset-y-0 left-0 flex items-center pl-4">
						<svg class="fill-current text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
							<path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
						</svg>
					</div> 
					<input type="text" v-model='search' name="email_address" placeholder="arayayin..." required="required" class="flex-shrink-1 block w-full border-2 pl-12 pr-5 py-3 rounded-lg text-lg appearance-none focus:outline-none focus:border-teal-400">
				</div>
				<div v-if='search.length>=3'>
					<div v-for='kitap in filtre' class="mb-4 bg-gray-200 text-gray-600 rounded-lg p-4 shadow">
						<h4 class="text-teal-600 mb-2 flex justify-between">
							<span>@{{ kitap.KITAP }}</span>
							<span class='italic'>@{{ kitap.YAZAR }}</span>
						</h4>
						<p class="italic font-thin mb-2">@{{ kitap.SORUN }}</p>
						<p class="mb-2 font-light">@{{ kitap.NEDEN }}</p>
						<p class="leading-normal">@{{ kitap.DUSUNCE_MODEL }}</p>
					</div>
				</div>
			</div>
			<div v-else>
				<div v-if='kaydedildi' class="bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative" role="alert">
					<strong class="font-bold">Bilgiler kaydedildi!</strong>
					<span class="absolute top-0 bottom-0 right-0 px-4 py-3">
						<svg @click='kaydedildi=0' class="fill-current h-6 w-6 text-teal-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
					</span>
				</div>
				<form class='w-full bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4'>
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full px-3">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
							Kitap
							</label>
							<input v-model='kitap' class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" type="text" placeholder="Kitap adı">
						</div>
					</div>
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full px-3">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
							Yazar
							</label>
							<input v-model='yazar' class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" type="text" placeholder="Yazarı">
						</div>
					</div>
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full px-3">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
							Sorun
							</label>
							<input v-model='sorun' class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" type="text" placeholder="Sorun">
						</div>
					</div>
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full px-3">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
							Neden
							</label>
							<input v-model='neden' class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" type="text" placeholder="Neden">
						</div>
					</div>
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full px-3">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
							Düşünce Modeli
							</label>
							<textarea v-model='dusunce_model' class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-teal-500" placeholder="Düşünce modeli"></textarea>
						</div>
					</div>
					<div class="flex items-center justify-between">
						<a class="inline-block align-baseline font-bold text-sm text-teal-500 hover:text-teal-800" href="#" @click='vazgec()'>
							Vazgeç
						</a>
						<button @click='kaydet' class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
							Kaydet
						</button>
					</div>
				</form>
			</div>
		</div>
		<script src="js/app.js"></script>
        <script>
            var vue = new Vue({
                el:'#app',
                data:{
					isOpen:false,
					ekle:0,
					search:'',
                    kitaplar:{!! $kitaplar !!},
					sorun:null,
					neden:null,
					kitap:null,
					dusunce_model:null,
					yazar:null,
					kaydedildi:0,
                },
				computed:{
					siralama(){
						return _.orderBy(this.kitaplar,function(kitap){return kitap.sorun},'asc');
					},
					filtre() {
							return this.siralama.filter(liste => {
								var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
								sorun = liste.SORUN != null ? liste.SORUN.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
								neden = liste.NEDEN != null ? liste.NEDEN.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
								dusunce_model = liste.DUSUNCE_MODEL != null ? liste.DUSUNCE_MODEL.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
								kitap = liste.KITAP != null ? liste.KITAP.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; }) : ''
								search = this.search.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; })
								return sorun.toLowerCase().indexOf(search.toLowerCase()) > -1 ||
										neden.toLowerCase().indexOf(search.toLowerCase()) > -1 ||
										dusunce_model.toLowerCase().indexOf(search.toLowerCase()) > -1 ||
										kitap.toLowerCase().indexOf(search.toLowerCase()) > -1 
							})
					},
				},
				created(){
					const handleEscape = (e) =>{
						if(e.key === 'Esc' || e.key === 'Escape'){
							this.isOpen = false
						}
					}
					document.addEventListener('keydown',handleEscape)
					this.$once('hook:beforeDestroy',()=>{
						document.removeEventListener('keydown',handleEscape)
					})
				},
				methods:{
					vazgec(){
						this.kitap=null;
						this.yazar=null;
						this.sorun=null;
						this.neden=null;
						this.dusunce_model=null;
						this.ekle=0;
					},
					kaydet(){
						self=this;
						axios.post('/',{kitap:this.kitap,yazar:this.yazar,sorun:this.sorun,neden:this.neden,dusunce_model:this.dusunce_model})
							.then(function(){
								self.kaydedildi=1;
								self.kitap=null;
								self.yazar=null;
								self.sorun=null;
								self.neden=null;
								self.dusunce_model=null;
							})
					}
				}
            });
        </script>
    </body>
</html>
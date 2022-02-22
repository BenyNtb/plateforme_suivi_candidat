<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MolenGeek - dashboard</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/natchez.css')}}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            {{-- <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header> --}}

            <!-- Page Content -->
            <main>
                <div class="flex">
                    <!-- component -->
                    <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-200 text-white"> 
                        <div class="fixed flex flex-col top-0 left-0 w-64 bg-gray-800 h-full border-purple-400">
                            <div class="flex items-center justify-center">
                                <img src="/img/MG_LOGO_fav.png" alt="logo MG">
                            </div>

                            <h4 class="text-center my-2 text-lg">{{ Auth::user()->nom }} {{ Auth::user()->prenom}}</h4>
                            <a href="{{route('home')}}"
                            class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Retour vers le site</span>
                        </a>

                            <div class="overflow-y-auto overflow-x-hidden flex-grow">
                                <ul class="flex flex-col py-4">
                                    <li>
                                        <a href="{{route('dashboard')}}"
                                            class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                                            <span class="inline-flex justify-center items-center ml-4">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                                    </path>
                                                </svg>
                                            </span>
                                            <span class="ml-2 text-sm tracking-wide truncate">Profil</span>
                                        </a>
                                    </li>
                                    <li>
                                        {{-- <a href="{{route('index.classe')}}"
                                            class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                                            <span class="inline-flex justify-center items-center ml-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                                </svg>                                            
                                            </span>
                                            <span class="ml-2 text-sm tracking-wide truncate">Ma Classe</span>
                                        </a> --}}
                                    </li>
                                    <li>
                                        {{-- <a href="{{route('calendrier.index')}}"
                                            class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                                            <span class="inline-flex justify-center items-center ml-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                                                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                </svg>
                                                </span>
                                            <span class="ml-2 text-sm tracking-wide truncate">Calendrier</span>
                                        </a> --}}
                                    </li>
                                    <li>
                                        
                                    </li>
                                    <li class="px-5">
                                        <div class="flex flex-row items-center h-8">
                                            <div class="text-sm font-light tracking-wide text-gray-500">Evenements</div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{route('seance.index')}}"
                                            class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                                            <span class="inline-flex justify-center items-center ml-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-check" viewBox="0 0 16 16">
                                                    <path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                                                    <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                                                </svg>
                                            </span>
                                            <span class="ml-2 text-sm tracking-wide truncate">Ton parcours</span>
                                            {{-- <span
                                                class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-green-500 bg-green-50 rounded-full {{count(Auth::user()->seance_user)==0? 'hidden': ''}}" >{{count(Auth::user()->seance_user)}}</span> --}}
                                        </a>
                                    </li>
                                        <form action="{{route('logout')}}" method="post" class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                                            @csrf
                                            <button type='submit'
                                            class="inline-flex justify-center items-center">
                                                <span class="inline-flex justify-center items-center ml-4">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span class="ml-2 text-sm tracking-wide truncate">Se déconnecter</span>
                                            </button>
                                        </form>
                                        <li>
                                            {{-- <a href="{{route('condition.index')}}"
                                                class="relative flex flex-row items-center h-11 focus:outline-none  text-white  border-l-4 border-transparent  pr-6">
                                                <span class="inline-flex justify-center items-center ml-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-gray-700 bi bi-file-text" viewBox="0 0 16 16">
                                                        <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                                    </svg>                                                </span>
                                                <span class="ml-2 text-gray-600	text-sm tracking-wide truncate">Condition d'utilisation </span>
                                            </a> --}}
                                        </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-full dash_space h-screen">
                        <div class="px-20 flex flex-col justify-center items-center h-screen">
                            <div class="bg-white overflow-hidden shadow-lg rounded-2xl height_size w-11/12 p-8" style="overflow-y: scroll; max-height:90vh;">                                
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                    
                </div>
            
            </main>
        </div>
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace( 'summary-ckeditor', {
                filebrowserUploadMethod: 'form';
            });
            </script>  
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>

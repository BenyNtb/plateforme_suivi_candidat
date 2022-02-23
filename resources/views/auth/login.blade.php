<x-guest-layout>
    @php
        $url = url()->current();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
    @endphp
    <div class="my-5">
        <div class="lg:flex">
            <div class="lg:w-5/12 px-10 sm:px-32">
                <a href="https://molengeek.com/">
                    <h2 class="p-0 mb-10 uppercase font-bold text-xl text-purple-800">Molengeek</h2>
                </a>
                <h2 class="p-0  uppercase font-bold sm:text-5xl text-4xl
                ">Inscrivez-vous et Ayez Accès a nos événements
                </h2>
                <img class="img_register" src="{{asset('img/working.png')}}" alt="">
            </div>
            <div class="lg:w-7/12 px-10 sm:px-32 my-auto">
        <form method="POST" action=" {{ $route == 'loginSeance' ? route('loginSeance', $seance->id) : route('login')  ; }}     ">
            @csrf

            <!-- Email Address -->
            <div class="w-full border-b border-purple-800 pt-8 sm:pt-">
                <x-label for="email"/>

                <x-input placeholder="Email" id="email" class="@error('email') is-invalid @enderror block mt-1 w-full border-none shadow-none placeholder-purple-300" type="email" name="email" :value="old('email')" required />
                @error('email')
                <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                @enderror
            </div>
            <!-- Password -->
            <div class="w-full border-b border-purple-800 pt-8 ">
                <x-label for="password"/>
                <x-input placeholder="Mot De Passe" id="password" class="@error('password') is-invalid @enderror  block mt-1 w-full border-none shadow-none placeholder-purple-300"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                                @error('password')
                                <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 hidden" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
                @if ($route == 'loginSeance')
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register', $seance->id) }}">
                        {{ __('Créer un compte ?') }}
                    </a>
                    
                @endif

                <x-button class="ml-5 px-10 py-5  bg-gradient-to-r from-purple-800 to-purple-900 ">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

            </div>
        </div>
    </div>
</x-guest-layout>

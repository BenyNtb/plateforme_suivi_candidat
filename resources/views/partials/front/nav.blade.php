<header>
    <nav class="flex  justify-center">
        <div class="logo w-1/4  pl-10">
            <img src="/img/molenGeek.png" alt="">
        </div>
        <div class="w-2/4  navigation  flex flex-col items-center justify-center">

        </div>
        <div class="w-1/4 text-right  pr-10">
            <ul c>
                @guest
                <li><a href="{{route('login')}}">Login</a></li>
                @endguest
                @auth
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                @endauth
            </ul>
        </div>
    </nav>
</header>
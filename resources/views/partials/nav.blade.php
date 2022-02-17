<header>
    <nav class="flex  justify-center">
        <div class="logo w-1/4  pl-10">
            <img src="/img/molenGeek.png" alt="">
        </div>
        <div class="w-2/4  navigation  flex flex-col items-center justify-center">
            <h1>{{$text_accroche->texte}}</h1>
            @guest
            <button
                class="my-1 modal-open mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-purple-500 hover:border-purple-600 hover:bg-purple-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Rejoins
                nous</button>
            <!--Modal-->
            <div
                class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-40">
                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50 "></div>

                <div
                    class="modal-container bg-white w-11/12 md:max-w-4xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    {{-- btn echape --}}
                    <div
                        class=" modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50 ">
                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                        <span class="text-sm">(Esc)</span>
                    </div>

                    <!-- Add margin if you want to see some of the overlay behind the modal-->
                    <div class="modal-content py-4 text-left px-6  modal_newsleter">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Indiquer  vos  informations</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <form action="{{route('communauté.store_guest')}}" method="POST">
                        @csrf
                        {{-- nom prenom --}}
                        {{-- <div class="flex">
                            <div class="w-2/4 sm:pt-0 py-5 sm:pr-5">
                                <label for="nom" class="font-semibold text-gray-700 block pb-1">Nom</label>
                                <div class="flex">
                                    <input id="nom" name="nom"
                                        class="bg-gray-50 border-1  rounded-r px-4 py-2 w-full" type="text" />
                                </div>
                                @error('nom')
                                <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="w-2/4 sm:pt-0 py-5 sm:pr-5">
                                <label for="prenom" class="font-semibold text-gray-700 block pb-1">Prenom</label>
                                <div class="flex">
                                    <input id="prenom" name="prenom"
                                        class="bg-gray-50 border-1  rounded-r px-4 py-2 w-full" type="text" />
                                </div>
                                @error('prenom')
                                <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                                @enderror
                            </div>        
                        </div> --}}
                        <div class="w-full sm:pt-0 py-5 sm:pr-5">
                            <label for="email" class="font-semibold text-gray-700 block pb-1">Email</label>
                            <div class="flex">
                                <input id="email" name="email"
                                    class="bg-gray-50 border-1  rounded-r px-4 py-2 w-full" type="text" />
                            </div>
                            @error('email')
                            <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end pt-2">
                            <button
                                class="w-full  mb-3 bg-green-500 rounded-lg text-white hover:bg-green-600 hover:text-white-400 p-3"
                                type="submit">Valider</button>
                        </div>
                        </form>

                        <button
                            class="w-full mr-2 modal-close bg-red-500 p-3 rounded-lg text-white hover:bg-red-600">Fermer</button>
                    </div>
                </div>
            </div>
            @endguest
            @auth
            <a href="{{route('communauté.store_auth',Auth::user()->email)}}"><button class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-purple-500 hover:border-purple-600 hover:bg-purple-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Rejoins nous</button></a>
            @endauth
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
                {{-- script du modal --}}
                <script>
                    var openmodal = document.querySelectorAll('.modal-open')
                    for (var i = 0; i < openmodal.length; i++) {
                        openmodal[i].addEventListener('click', function (event) {
                            event.preventDefault()
                            toggleModal()
                        })
                    }
    
                    const overlay = document.querySelector('.modal-overlay')
                    overlay.addEventListener('click', toggleModal)
    
                    var closemodal = document.querySelectorAll('.modal-close')
                    for (var i = 0; i < closemodal.length; i++) {
                        closemodal[i].addEventListener('click', toggleModal)
                    }
    
                    document.onkeydown = function (evt) {
                        evt = evt || window.event
                        var isEscape = false
                        if ("key" in evt) {
                            isEscape = (evt.key === "Escape" || evt.key === "Esc")
                        } else {
                            isEscape = (evt.keyCode === 27)
                        }
                        if (isEscape && document.body.classList.contains('modal-active')) {
                            toggleModal()
                        }
                    };
    
    
                    function toggleModal() {
                        const body = document.querySelector('body')
                        const modal = document.querySelector('.modal')
                        modal.classList.toggle('opacity-0')
                        modal.classList.toggle('pointer-events-none')
                        body.classList.toggle('modal-active')
                    }
                </script>    
</header>
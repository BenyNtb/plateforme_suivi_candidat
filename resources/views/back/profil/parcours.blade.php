<x-app-layout>
    <!-- component -->
    <!-- This is an example component -->
    <div>
        @php
            $url = url()->current();
            $route = app('router')
                ->getRoutes($url)
                ->match(app('request')->create($url))
                ->getName();
        @endphp
    
        <section class=" text-gray-200">
            <div class="max-w-6xl mx-auto px-5 py-10 ">
                <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
                    <h1
                        class=" title-font mb-2 text-4xl font-extrabold leading-10 tracking-tight text-left sm:text-5xl sm:leading-none md:text-6xl text-black">
                        TON PARCOURS</h1>
                        <a class="mb-3 px-1 text-l text-blue-500 italic underline hover:bg-blue-500 hover:text-white" href="mailto:nicolas@molengeek.com" target="_blank"><p class="">En cas de problème, contactez nous</p></a>

                </div>
                @include('layouts.flash')
                <div class="flex flex-wrap -m-2 ">
                    {{-- verifier s'il est deja inscrit pr un jour d itw --}}
                    {{-- @foreach (Auth::user()->inscrits as $seance)
                        @if ($seance->etape_id == 2 )
                            {{ $verif = true }}
                        @else
                            {{ $verif = false }}
                        @endif
                    @endforeach --}}
                    {{-- fin d itw --}}
                    
                    @forelse (Auth::user()->seance_candidat as $seance)
                    {{-- @forelse (Auth::user()->inscrits->sortBy('evenement_type_id') as $seance) --}}
                    
                        @php
                            $dateJour = \Carbon\Carbon::now();
                            $present = App\Models\SeanceCandidat::where('seance_id', $seance->seance->id)
                                ->where('candidat_id', Auth::user()->id)
                                ->withTrashed()
                                ->first();
                        @endphp
                        {{-- etat == 0 --}}
                        @if ($present->presence == 1 )
                        <div class="xl:w-1/3 md:w-1/2 p-4">
                            <div class="bg-green-500 p-6 rounded-lg">
                                    <div
                                        class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-calendar2-check" viewBox="0 0 20 20">
                                            <path
                                                d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                            <path
                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                            <path
                                                d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                        </svg>

                                    </div>
                                    <h2 class="text-lg  font-medium title-font mb-2">
                                        {{ ucfirst($seance->seance->evenement_type->nom) }}  <br>
                                        {{ ucfirst($seance->seance->etape->nom) }}</h2>
                                    <p class="leading-relaxed text-base">
                                        {{ date('d M', strtotime($seance->seance->date_debut)) }}
                                        {{ date('H:i', strtotime($seance->seance->heure_debut)) }}
                                    </p>
                                    <p class="leading-relaxed text-base">
                                        {{ $seance->seance->lieu }}
                                    </p>
                                    @if ($seance->seance->etape->nom == 'week' && Auth::user()->role_id == 1)
                                        <p class="text-base text-indigo-700 font-bold">
                                            Vous allez recevoir un email de confirmation d'inscription
                                        </p>
                                        
                                    @endif
                                    <div class="text-center mt-2 leading-none flex justify-between w-full">
                                        <div class="text-center mt-2 leading-none flex justify-between w-full">
                                            <span class=" inline-flex items-center leading-none text-md font-bold">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-calendar2-check"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                    <path
                                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                                    <path
                                                        d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                                </svg>

                                                Present
                                            </span>
                                        </div>
                                        @if ($seance->seance->etat == 0 && $seance->seance->seance_candidat->where('candidat_id', Auth::user()->id)->first()->inscrit == 1 && $seance->seance->etape->nom != 'interview')
                                            <a href="{{ route('inscription.date', [$seance->seance->evenement_type->id, $seance->seance]) }}"><button
                                                    class="bg-white text-gray-800 font-bold rounded border-b-2 border-purple-700 hover:border-purple-900 hover:bg-purple-700 hover:text-white shadow-md py-2 px-2 inline-flex items-center">Inscrire
                                                    Interview</button></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif ($dateJour->format('Y-m-d') < $seance->seance->date_debut ) 
                            <div class="xl:w-1/3 md:w-1/2 p-4 relative">
                                <div class="bg-gray-500 p-6 rounded-lg">
                                    <div
                                        class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>
                                    </div>
                                    <a href="{{ route('seance.cancel', [$seance->seance->id]) }}" class=" "><button
                                        class="bg-red-700 absolute top-0 right-0 text-white w-10 h-10 inline-flex items-center justify-center rounded-full">
                                        X</button></a>

                                    <h2 class="text-lg  font-medium title-font mb-2">
                                        {{ ucfirst($seance->seance->evenement_type->nom) }}  <br>
                                        {{ ucfirst($seance->seance->etape->nom) }}</h2>
                                    <p class="leading-relaxed text-base">
                                        {{ date('d M', strtotime($seance->seance->date_debut)) }}
                                        {{ date('H:i', strtotime($seance->seance->heure_debut)) }}

                                    </p>
                                    <p class="leading-relaxed text-base">
                                        {{ $seance->seance->lieu }}

                                    </p>
                                    <div class="text-center mt-2 leading-none flex justify-between w-full">
                                        <div class="text-center mt-2 leading-none flex justify-between w-full">
                                            <span class=" inline-flex items-center leading-none text-md font-bold">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-calendar-event"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                                    <path
                                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                </svg>
                                                Prévu
                                            </span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        @elseif ($dateJour->format('Y-m-d') == $seance->seance->date_debut || $dateJour->format('Y-m-d') < $seance->seance->date_fin)

                            <div class="xl:w-1/3 md:w-1/2 p-4">
                                <div class="bg-blue-500 p-6 rounded-lg">
                                    <div
                                        class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-lg  font-medium title-font mb-2">
                                        {{ ucfirst($seance->seance->evenement_type->nom) }}  <br>
                                        {{ ucfirst($seance->seance->etape->nom) }}</h2>
                                    <p class="leading-relaxed text-base">
                                        {{ date('d M', strtotime($seance->seance->date_debut)) }}
                                        {{ date('H:i', strtotime($seance->seance->heure_debut)) }}

                                    </p>
                                    <p class="leading-relaxed text-base">
                                        {{ $seance->seance->lieu }}

                                    </p>
                                    <div class="text-center mt-2 leading-none flex justify-between w-full">
                                        <div class="text-center mt-2 leading-none flex justify-between w-full">
                                            <span class=" inline-flex items-center leading-none text-md font-bold">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-check2-circle"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                                    <path
                                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                </svg>
                                                En cours
                                            </span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        @elseif ($dateJour->format('Y-m-d') > $seance->seance->date_debut ||$dateJour->format('Y-m-d') > $seance->seance->date_fin )
                            <div class="xl:w-1/3 md:w-1/2 p-4">
                                <div class="bg-red-500 p-6 rounded-lg">
                                    <div
                                        class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-lg  font-medium title-font mb-2">
                                        {{ ucfirst($seance->seance->evenement_type->nom) }}  <br>
                                        {{ ucfirst($seance->seance->etape->nom) }}</h2>
                                    <p class="leading-relaxed text-base">
                                        {{ date('d M', strtotime($seance->seance->date_debut)) }}
                                        {{ date('H:i', strtotime($seance->seance->heure_debut)) }}

                                    </p>
                                    <p class="leading-relaxed text-base">
                                        {{ $seance->seance->lieu }}

                                    </p>
                                    <div class="text-center mt-2 leading-none flex justify-between w-full">
                                        <div class="text-center mt-2 leading-none flex justify-between w-full">
                                            <span class=" inline-flex items-center leading-none text-md font-bold">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-clock-history"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                                    <path
                                                        d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                                    <path
                                                        d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                                Manqué
                                            </span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        @endif
                            
                    @empty
                        <p class="leading-relaxed text-base text-black">Pas de séance en cours</p>

                    @endforelse
                </div>

            </div>
        </section>

    </div>
</x-app-layout>

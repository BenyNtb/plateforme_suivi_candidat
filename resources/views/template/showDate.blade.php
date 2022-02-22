@extends('layouts.index')
@php
    $jour = \Carbon\Carbon::now();
@endphp


@section('content')
    @php
        $limite = $seances->where('etape_id', 1)->where('limite', ">", 0)->where('date_debut', '>', $jour->format('Y-m-d'));
        $seances = $limite->sortBy('date_debut');
    @endphp
    @foreach ($seances as $seance)
    <div class="z-30 relative items-center justify-center w-full h-full overflow-auto">
        <div class="mx-auto my-2 relative shadow-2xl rounded-lg w-4/5 h-96 bg-cover bg-center"
                style=" 
                background-image: 
                url('../img/webdev.jpg');">
                <div class="absolute w-1/2 -right-1 flex sm:col-span-12 md:col-span-5 lg:col-span-5 xxl:col-span-5">
                    <div class="flex flex-col justify-center content-center  bg-yellow-400 w-full h-full md:h-96 w-full bg-opacity-75 rounded-tr-lg rounded-br-lg">
                        <div class="w-3/4 mx-auto flex flex-col">
                            <p class="italic text-white sm:text-xl md:text-3xl lg:text-4xl uppercase text-center  font-semibold " id="seances">
                                {{$seance->etape->nom}} {{$seance->evenement_type->nom}}
                            </p>
                            <p class="italic text-white sm:text-xl md:text-3xl lg:text-4xl text-center " id="date">
                                {{date('d M', strtotime($seance->date_debut))}} 
                                {{date('H:i', strtotime($seance->heure_debut))}}
                            </p>
                            @auth
                            @php
                                $seance_inscrit = Auth::user()->inscrits;
                            @endphp
                                @if ($seance_inscrit->contains('id', $seance->id)) 
                                <a
                                class="opacity-75  mt-3 bg-purple-600 bg-opacity-90  text-sm font-bold py-6 px-8 rounded inline-flex items-center">
                                    <span class="text-base">déjà inscrit!</span>
                                </a>
                                @else
                                <form action="{{route('inscription', $seance->id)}}" method="post" >
                                    @csrf
                                    <button
                                    type="submit" class="opacity-75 inline-flex items-center  mt-3 bg-gray-100 hover:bg-purple-600 bg-opacity-90 hover:text-white text-sm font-bold py-6 px-8 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-base">Inscris toi!</span>                                               
                                </button>
                                </form>
                                @endif
                        @endauth
                        @guest
                            <a class="opacity-75  mt-3 bg-gray-100 hover:bg-purple-600 bg-opacity-90 hover:text-white text-sm font-bold py-6 px-8 rounded inline-flex items-center"
                                href="{{ route('register', $seance->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-base">Inscris toi!</span>
                            </a>
                        @endguest
        </div>
                    </div>
                </div>
            </div>
            @endforeach

    </div>
@endsection
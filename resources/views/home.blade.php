@extends('layouts.index')
@php
    $jour = \Carbon\Carbon::now();
@endphp

@section('content')
<div class="z-30 relative flex flex-row flex-wrap w-4/5 mx-auto">
    @include('layouts.flash')
    @isset($types)
        @forelse ($types as $type)
            @php
                $limite = $type->seances
                    ->where('limite', '>', 0)
                    ->where('etat', 1)
                    ->where('etape_id', 1)
                    ->where('date_debut', '>', $jour->format('Y-m-d'));
                $seance = $limite->sortBy('date_debut')->first();
            @endphp
            @isset($seance)
                <div class="mx-2 my-4 relative  rounded-lg w-full  h-96 bg-cover bg-center"
                    style=" {{ Str::contains($type->nom, 'coding') ? "background-image: url('img/webdev.jpg');" : (Str::contains($type->nom, 'hack') ? "background-image: url('img/hack2.jpg');" : "background-image: url('img/hack.jpg');") }} ">
                    <div class="absolute w-1/2 -right-0.5 flex sm:col-span-12 md:col-span-5 lg:col-span-5 xxl:col-span-5">
                        <div
                            class="{{ Str::contains($type->nom, 'coding') ? 'bg-yellow-400' : (Str::contains($type->nom, 'web') ? 'bg-blue-400' : 'bg-indigo-400') }} flex flex-col justify-center content-center  bg-yellow-400 w-full h-full md:h-96 w-full bg-opacity-75 rounded-tr-lg rounded-br-lg">
                            <div class="w-3/4 mx-auto flex flex-col">
                                <p class="italic text-white sm:text-xl md:text-3xl lg:text-4xl uppercase text-center  font-semibold "
                                    id="seance">
                                    {{-- {{ $seance->etape->nom }} {{ $type->nom }} --}}
                                </p>
                                <p class="italic text-white sm:text-l md:text-2xl lg:text-3xl text-center " id="date">
                                    {{ date('d M', strtotime($seance->date_debut)) }}
                                    {{ date('H:i', strtotime($seance->heure_debut)) }}
                                </p>
                                <p class="italic text-white sm:text-l md:text-2xl lg:text-3xl text-center ">
                                    {{ $seance->lieu }}
                                </p>
                                @include('partials.front.btnInscrit')
                                <a href="{{ route('date.index', $type->id) }}" class="text-white italic  text-xl ">Plus de dates</a>
                                <a href="{{ route('seance.description', $seance->id) }}" class="text-white italic underline text-2xl absolute right-5 bottom-3">Voir détails</a>
                            </div>
                        </div>
                        <p class="absolute bottom-10 right-10 italic text-white sm:text-sm md:text-xl lg:text-2xl">
                            @if ($seance->limite <= 10)
                                Plus que {{ $seance->limite }} places disponibles
                            @endif
                        </p>
                    </div>
                </div>
            @endisset
        @empty
            <p>Il n'y a pas de séances d'informations en cours</p>

        @endforelse
    @endisset
</div>

@endsection
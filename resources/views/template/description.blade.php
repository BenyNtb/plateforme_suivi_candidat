@extends('layouts.index')
@php
    \Carbon\Carbon::setLocale('fr');
@endphp
@section('content')
    <div class="z-30 relative flex flex-row flex-wrap w-4/5 mx-auto">
        <div class="mx-2 relative  rounded-lg w-full  h-96 bg-cover bg-center" style= "background-image: url('/img/webdev.jpg');">
            <div class="absolute w-1/2 -right-0.5 flex sm:col-span-12 md:col-span-5 lg:col-span-5 xxl:col-span-5">
                <div
                    class=" bg-blue-400 flex flex-col justify-center content-center w-full h-full md:h-96 w-full bg-opacity-75 rounded-tr-lg rounded-br-lg">
                    <div class="w-3/4 mx-auto flex flex-col">
                        <p class="italic text-white sm:text-xl md:text-3xl lg:text-4xl uppercase text-center  font-semibold "
                            id="seance">
                            {{$seance->etape->nom}}  {{$seance->evenement_type->nom}}
                        </p>
                            <p class="italic text-white sm:text-l md:text-2xl lg:text-3xl text-center " id="date">
                                {{ date('d M', strtotime($seance->date_debut)) }}
                                {{ date('H:i', strtotime($seance->heure_debut)) }}
                            </p>
                        <p class="italic text-white sm:text-l md:text-2xl lg:text-3xl text-center ">
                            {{$seance->lieu}}
                        </p>
                        @include('layouts.boutonInscrit')
                    </div>
                </div>
                <p class="absolute bottom-10 right-10 italic text-white sm:text-sm md:text-xl lg:text-2xl">
                    @if ($seance->limite <= 10)
                        Plus que {{$seance->limite}} places disponibles
                    @endif
                </p>
            </div>
        </div>

        <div class="mx-2 p-10 relative  rounded-lg w-full  text-xl   shadow " >
            <div class="my-4">
                <blockquote class="font-bold">&lt;&lt; Maintenant je peux développer n'importe quel site web, easy game. &gt;&gt;</blockquote>
                <h3>Cette formation appelle toute personne désireuse d'apprendre à <strong>coder</strong> des sites internet et d'en <strong>maîtriser</strong> tous les outils.</h3>
                <h3>Grâce à la Coding School tu vas pouvoir créer des <strong>pages web </strong>dynamiques, coder des <strong>sites</strong> internet <strong>personnalisés</strong> pour tes clients, tes projets personnels, des entreprises et bien plus !</h3>
                <ul class="list-disc ml-5">
                    <li><strong> Tu as entre 18 et 30 ans ?</strong></li>
                    <li><strong> Tu es chercheur d'emploi basé dans la Région de Bruxelles Capitale ou ses alentours ?</strong></li>
                    <li><strong> Tu veux surfer sur la vague numérique et être prêt pour les métiers de l'avenir ?</strong></li>
                </ul>
                <p class="mt-2">Intéressée<strong> </strong>par le monde du web ? Acquiert les compétences fondamentales et devient <strong><em>Full Stack Web Développeur*</em></strong>.</p>
                <p><strong>* </strong>Être "<strong>Full Stack Web Développeur",</strong> c'est stylé non ? Oui , mais c'est surtout <strong>très utile</strong> dans le monde d'aujourd'hui.</p>
            </div>
            <div class="my-4">
                <h2 class="text-3xl font-semibold">LA particularité de la Coding School ?</h2>
                <h3 class="">Pas de blabla inutile, commence directement avec de la <strong>pratique</strong> (tout en incluant évidemment le nectar de la théorie). </h3>
                <h3>Tes coachs seront là pour t'épauler, te soutenir et te guider là où TU veux aller.</h3>
                <p>Un projet te tient à cœur ? Tu as déjà des idées ? Ou rien du tout ? Aucun problème, tu auras 6 mois intensifs pour développer tes compétences et aller dans la direction que tu veux ;)</p>
            </div>
            <div class="my-4">
                <h2>Dans notre "School" tu maîtriseras tous les outils et langages d'un vrai Web Développeur :</h2>
                <ul class="list-disc ml-5">
                    <li><strong>HTML/CSS</strong></li>
                    <li><strong>JAVASCRIPT</strong></li>
                    <li><strong>BOOTSTRAP</strong></li>
                    <li><strong>LARAVEL</strong></li>
                    <h1 class="font-bold italic">&lt;&lt; Pas besoin d'être Einstein, avant j'y connaissais rien du tout, mais aujourd'hui...&gt;&gt;
                </ul>
            </div>
            <div class="my-4">
                <h2 class="font-semibold underline mb-2">Rejoins-nous à la {{ucfirst($seance->etape->nom)}}  {{ucfirst($seance->evenement_type->nom)}}
                    ! </h2>
                <p><strong>Date : </strong>Le {{ date('d/m/o', strtotime($seance->date_debut)) }} à 
                {{ date('H:i', strtotime($seance->heure_debut)) }}
                </p>
                <p><strong>Lieu : </strong> {{$seance->lieu}} </p>
                @auth
                @php
                    $seance_inscrit = Auth::user()->seance_user;
                @endphp
                    @if ($seance_inscrit->contains('seance_id', $seance->id)) 
                    <a
                    class="opacity-75  mt-3 bg-purple-600 bg-opacity-90  text-sm font-bold py-6 px-8 rounded inline-flex items-center">
                        <span class="text-base">déjà inscrit!</span>
                    </a>
                    @else
                    <form action="{{route('inscription', $seance->id)}}" method="post" >
                        @csrf
                        <button
                        type="submit" class="inline-flex items-center  mt-3 bg-purple-300 hover:bg-purple-600  hover:text-white text-sm font-bold py-6 px-8 rounded">
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
                <a class=" mt-3 bg-purple-100 hover:bg-purple-600  hover:text-white text-sm font-bold py-6 px-8 rounded inline-flex items-center"
                    href="{{ route('loginSeance', $seance->id) }}">
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
@endsection
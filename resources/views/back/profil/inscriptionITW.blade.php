<x-app-layout>

        @forelse ($interviews as $seance)
            <section class="my-2 flex items-center justify-center px-4 bg-white">
                <div class=" w-full rounded-lg shadow-lg p-4 flex md:flex-row flex-col">
                    <div class="flex-1">
                        <h3 class="font-bold text-xl tracking-wide">{{ucfirst($seance->etape->nom)}} {{ucfirst($seance->evenement_type->nom)}}</h3>
                        <p class="leading-relaxed text-md">
                            {{ date('d M Y' , strtotime($seance->date_debut)) }}
                            {{ date('H:i', strtotime($seance->heure_debut)) }}
                        </p>
                        <p class="leading-relaxed font-semibold text-md text-indigo-700">
                            @if ($seance->limite <= 10)
                                Plus que {{$seance->limite}} disponibles
                            @endif
                        </p>
                    </div>
                    <div class="md:px-2  md:mt-0 items-center flex">
                        <form action="{{route('inscription.interview', $seance->id)}}" method="post">
                            @csrf
                            <input type="number" name="inscrit" id="inscrit" value="{{$inscrit->id}}" hidden>
                            <button  type="submit" class="bg-indigo-600 text-white font-bold px-4 py-2 text-sm uppercase rounded tracking-wider focus:outline-none hover:bg-indigo-700"> S'inscrire</button>
                        </form>
                    </div>
                </div>
            </section> 
        @empty
            <section class="my-2 flex items-center justify-center px-4 bg-white">
                <p>il n'y a pas encore de jours d'interview de prévu</p>
            </section>
        @endforelse

</x-app-layout>
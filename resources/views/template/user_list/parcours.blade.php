<div class="py-10 flex justify-center items-center flex-col border-b-2 border-purple-100">
    <h2 class="text-3xl">Ses séances </h2>
    <div class="px-10 mt-3">
        <div class=" flex space-x-1 flex-noxrap">
        @forelse ($etudiant->inscrits->sortBy('evenement_type_id') as $seance)
            <div class="sm:3/4 bg-green-500 p-6 rounded-lg">
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
                <h2 class="text-white text-lg  font-medium title-font mb-2">
                    {{ ucfirst($seance->evenement_type->nom) }}  <br>
                    {{ ucfirst($seance->etape->nom) }}</h2>
                <p class="text-white leading-relaxed text-base">
                    {{ date('d M', strtotime($seance->date_debut)) }}
                    {{ date('H:i', strtotime($seance->heure_debut)) }}
                </p>
            </div>
            @empty 
                <p>Aucune séance à afficher</p>
            
            @endforelse
        </div>

    </div>
</div>
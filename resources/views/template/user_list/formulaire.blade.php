@php
    $seances = App\Models\Seance::where('etape_id', 2)->get();
    $interview = false;
    foreach ($seances as $seance ) {
        foreach ($etudiant->inscrits as $item ) {
            if ($seance->id == $item->id) {
                $interview = true;
            }
        }
    }
@endphp
@if ($interview)
    <div class="border-b-2 border-purple-100 py-10">
        <h2 class="text-5xl">Formulaire</h2>
        {{-- form Molengeek --}}
        <div
            class="flex items-center justify-around border border-gray-200 py-4 my-3 px-3 bg-gray-50 rounded-lg shadow-md">
            <h2 class="text-xl">Formulaire interview MolenGeek</h2>
            {{-- condition formulaire rempli --}}
            @forelse ($form_molen->where('user_id',$etudiant->id) as $item)
            <div>

                <a href="{{ route('view.formulaire.molengeek',$etudiant->id) }}" class=""><button
                        class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-500 hover:border-indigo-600 hover:bg-indigo-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                            class="fas fa-eye pr-5"></i>voir</button></a>
                <a href="{{ route('edit.formulaire.molengeek',$etudiant->id) }}" class=""><button
                        class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-500 hover:border-indigo-600 hover:bg-indigo-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                            class="fas fa-edit pr-5"></i>Edit</button></a>
            </div>
            @empty
            <a href="{{ route('validation.formulaire.molengeek',$etudiant->id)}}" class=""><button
                    class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-500 hover:border-indigo-600 hover:bg-indigo-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                        class="fas fa-edit pr-5"></i>Remplir</button></a>
            @endforelse
        </div>
        {{-- form partenaire --}}
        <div
            class="flex items-center justify-around border border-gray-200 py-4 my-3 px-3 bg-gray-50 rounded-lg shadow-md">
            <h2 class="text-xl">Formulaire interview Partenaire</h2>
            {{-- condition formulaire rempli --}}
            @forelse ($form_part->where('user_id',$etudiant->id) as $item)
            <div>
                <a href="{{ route('view.formulaire.partenaire',$etudiant->id) }}" class=""><button
                        class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-500 hover:border-indigo-600 hover:bg-indigo-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                            class="fas fa-eye pr-5"></i>voir</button></a>
                <a href="{{ route('edit.formulaire.partenaire',$etudiant->id) }}" class=""><button
                        class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-500 hover:border-indigo-600 hover:bg-indigo-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                            class="fas fa-edit pr-5"></i>Edit</button></a>
            </div>
            @empty
            <a href="{{ route('validation.formulaire.partenaire',$etudiant->id)}}" class=""><button
                    class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-500 hover:border-indigo-600 hover:bg-indigo-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                        class="fas fa-edit pr-5"></i>Remplir</button></a>
            @endforelse
        </div>
        {{-- BTN envoyer mail invitation school --}}
        <div class="flex justify-center mt-5">
            @if ($form_part->where('user_id',$etudiant->id)->count() == 0)
            <a href="" class=""><button disabled
                    class="mx-3 bg-gray-300 text-2xl text-gray-200 font-bold rounded border-b-2 border-gray-500 shadow-md py-5 px-6 inline-flex items-center"><i
                        class="fas fa-arrow-up pr-5"></i>Remplir les formulaires <i
                        class="fas fa-arrow-up pl-5"></i></button></a>
            @else
            {{-- <a href="{{ route('validation.formulaire.molengeek',$etudiant->id)}}" class=""><button
                    class="mx-3 bg-white text-2xl text-gray-800 font-bold rounded border-b-2 border-indigo-500 hover:border-indigo-600 hover:bg-indigo-600 hover:text-white shadow-md py-5 px-6 inline-flex items-center"><i
                        class="fas fa-share pr-5"></i>Envoyer invitation en Coding Week</button></a> --}}
            @endif
        </div>
    </div>
@endif


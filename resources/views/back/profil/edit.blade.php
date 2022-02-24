<x-app-layout>
    <div class="pb-6 m-auto flex flex-col justify-center	content-center">
        <div class="flex justify-between">
            <h2 class="text-4xl">Modifier Mon Profil</h2>
            <a href="{{ route('dashboard') }}"><button
                    class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-purple-500 hover:border-purple-600 hover:bg-purple-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                        class="fas fa-user-edit pr-5"></i>Retour</button></a>
        </div>
        <form action="{{ route('profil.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data"
            class="my-5">
            @csrf
            @method('PUT')
            <div class="sm:flex">
                <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                    <label for="nom" class="font-semibold text-gray-700 block pb-1">Nom</label>
                    <div class="flex">
                        <input name="nom" id="nom" class="border border-gray-400 rounded-lg px-4 py-2 w-full"
                            type="text" value="{{ Auth::user()->nom }}" />
                    </div>
                    @error('nom')
                        <span class="feedback-invalid text-xs  text-red-700">{{ $message }}</span>
                    @enderror

                </div>
                {{-- prenom --}}
                <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                    <label for="prenom" class="font-semibold text-gray-700 block pb-1">Prenom</label>
                    <div class="flex">
                        <input name="prenom" id="prenom" class="border border-gray-400 rounded-lg px-4 py-2 w-full"
                            type="text" value="{{ Auth::user()->prenom }}" />
                    </div>
                    @error('prenom')
                        <span class="feedback-invalid text-xs text-red-700">{{ $message }}</span>
                    @enderror

                </div>
            </div>
            <div class="sm:flex pt-5">
                {{-- formation --}}
                <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                    <label for="formation" class="font-semibold text-gray-700 block pb-1">Intérêt</label>
                    <div class="flex">
                        <select
                            class="@error('formation') is-invalid @enderror border border-gray-400 rounded-lg px-4 py-2 w-full"
                            name="formation">
                            <option disabled class="">Entrez vos intérêt </option>
                            <option value="Formation longue" class="text-black"
                                {{ Auth::user()->infos->formation == 'Formation longue' ? 'selected' : '' }}>
                                Formation longue</option>
                            <option value="Formation courte" class="text-black"
                                {{ Auth::user()->infos->formation == 'Formation courte' ? 'selected' : '' }}>
                                Formation courte</option>
                            <option value="Evénement (workshop, Hackaton, etc)" class="text-black"
                                {{ Auth::user()->infos->formation == 'Evénement (workshop, Hackaton, etc)' ? 'selected' : '' }}>
                                Evénement (workshop, Hackaton, etc)</option>
                        </select>
                        @error('formation')
                            <span class="feedback-invalid text-xs text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- statut --}}
                <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                    <label for="statut" class="font-semibold text-gray-700 block pb-1">Statut</label>
                    <div class="flex">
                        <select
                            class="@error('statut') is-invalid @enderror border border-gray-400 rounded-lg px-4 py-2 w-full"
                            name="statut">
                            <option disabled class="">Entrez votre statut *</option>
                            <option value="eemandeur d'emploi"
                                {{ Auth::user()->infos->statut == 'Demandeur d\'emploi' ? 'selected' : '' }}>
                                Demandeur d'emploi</option>
                            <option value="etudiant"
                                {{ Auth::user()->infos->statut == 'Etudiant' ? 'selected' : '' }}>Etudiant</option>
                            <option value="autre" {{ Auth::user()->infos->statut == 'autre' ? 'selected' : '' }}>
                                Autre</option>
                        </select>
                        @error('statut')
                            <span class="feedback-invalid text-xs text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="sm:flex pt-5">
                {{-- email --}}
                <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                    <label for="email" class="font-semibold text-gray-700 block pb-1">Email</label>
                    <div class="flex">
                        <input name="email" id="email" class="border border-gray-400 rounded-lg px-4 py-2 w-full"
                            type="text" value="{{ Auth::user()->email }}" />
                    </div>
                    @error('email')
                        <span class="feedback-invalid text-xs  text-red-700">{{ $message }}</span>
                    @enderror

                </div>
                {{-- tel --}}
                <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                    <label for="telephone" class="font-semibold text-gray-700 block pb-1">Telephone</label>
                    <div class="flex">
                        <input name="telephone" id="telephone"
                            class="border border-gray-400 rounded-lg px-4 py-2 w-full" type="number"
                            value="0{{ Auth::user()->infos->phone }}" />
                    </div>
                    @error('telephone')
                        <span class="feedback-invalid text-xs  text-red-700">{{ $message }}</span>
                    @enderror

                </div>
            </div>
            <div class="sm:flex pt-5">
                {{-- sexe --}}
                <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                    <label for="genre_id" class="font-semibold text-gray-700 block pb-1">Genre</label>
                    <div class="flex">
                        <select
                            class="@error('genre') is-invalid @enderror border border-gray-400 rounded-lg px-4 py-2 w-full"
                            name="genre">
                            <option disabled selected value='3' class="">Entrez votre genre *</option>
                            @foreach ($genre as $item)
                                <option value="{{ $item->id }}"
                                    {{ Auth::user()->genre->id == $item->id ? 'selected' : '' }}>{{ $item->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('genre')
                            <span class="feedback-invalid text-xs  text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- naissance --}}
                <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                    <label for="naissance" class="font-semibold text-gray-700 block pb-1">Naissance</label>
                    <div class="flex">
                        <input name="naissance" id="naissance" name="naissance"
                            class="@error('naissance') is-invalid @enderror border border-gray-400 rounded-lg px-4 py-2 w-full"
                            type="date" value="{{ Auth::user()->infos->date_naissance }}" />
                    </div>
                    @error('naissance')
                        <span class="feedback-invalid text-xs  text-red-700">{{ $message }}</span>
                    @enderror

                </div>
            </div>
            <div class="sm:flex pt-5">
                {{-- commune --}}
                <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                    <label for="commune" class="font-semibold text-gray-700 block pb-1">Commune</label>
                    <div class="flex">
                        <input name="commune" id="commune" class="border border-gray-400 rounded-lg px-4 py-2 w-full"
                            type="text" value="{{ Auth::user()->infos->commune }}" />
                    </div>
                    @error('commune')
                        <span class="feedback-invalid text-xs  text-red-700">{{ $message }}</span>
                    @enderror

                </div>
                {{-- address --}}
                <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                    <label for="adresse" class="font-semibold text-gray-700 block pb-1">Adresse</label>
                    <div class="flex">
                        <input name="adresse" id="autocomplete" class="border border-gray-400 rounded-lg px-4 py-2 w-full"
                            type="text" value="{{ Auth::user()->infos->adresse }}" />
                    </div>
                    @error('adresse')
                        <span class="feedback-invalid text-xs  text-red-700">{{ $message }}</span>
                    @enderror

                </div>
            </div>
            <div class="sm:flex pt-5">
                {{-- objectif --}}
                <div class="w-full sm:w-3/4 sm:pr-5 px-5">
                    <label for="objectif" class="font-semibold text-gray-700 block pb-1">Objectif</label>
                    <div class="flex">
                        <textarea style="height:100px;resize:none" id="objectif" name="objectif"
                            class="border border-gray-400 rounded-lg px-4 py-2 w-full">{{ Auth::user()->infos->objectif }}</textarea>
                    </div>
                </div>
                {{-- pc portable --}}
                <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                    <label for="pc" class="font-semibold text-gray-700 block pb-1">PC portable
                        disponible</label>
                    <select class="@error('pc') is-invalid @enderror border border-gray-400 rounded-lg px-4 py-2 w-full"
                        id='pc' name="pc">
                        <option disabled selected value='3' class="">Pc disponible *</option>
                        <option value="1" {{ Auth::user()->infos->pc == 1 ? 'selected' : '' }}>oui</option>
                        <option value="0" {{ Auth::user()->infos->pc == 0 ? 'selected' : '' }}>non</option>
                    </select>
                    @error('pc')
                        <span class="feedback-invalid text-xs text-red-700">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="text-right mt-10">
                <button
                    class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                        class="fas fa-user-edit pr-5"></i>Valider</button>
            </div>
        </form>
    </div>
</x-app-layout>

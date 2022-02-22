<x-app-layout>
    <!-- component -->
    <!-- This is an example component -->
    <div class="flex items-center justify-center px-4">

        <div class="bg-white w-full ">
            <div class="p-4 border-b">
                <h2 class="text-2xl ">
                    Fiche étudiant
                </h2>
                <p class="text-sm text-gray-500">
                    Informations relatives à l'étudiant.
                </p>
            </div>
            <div>
                <form action="{{ route('etudiant.update', $etudiant->id) }}" method="post" enctype="multipart/form-data"
                    class="my-5">
                    @csrf
                    @method('PUT')
                    <div class="pb-6">
                        <div class="sm:flex">
                            <div class="w-full sm:w-2/4 sm:pr-5 px-5  ">
                                <label for="nom" class="font-semibold text-gray-700 block pb-1">Nom</label>
                                <div class="flex  border-b border-purple-800">
                                    <input id="nom" name="nom" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                        value="{{$etudiant->nom}}" />
                                </div>
                            </div>
                            {{-- prenom --}}
                            <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5  ">
                                <label for="prenom" class="font-semibold text-gray-700 block pb-1">Prenom</label>
                                <div class="flex  border-b border-purple-800">
                                    <input id="prenom" name="prenom" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                        value="{{$etudiant->prenom}}" />
                                </div>
                            </div>
                        </div>
                        <div class="sm:flex pt-5">
                            <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                                <label for="formation" class="font-semibold text-gray-700 block pb-1">Intérêt</label>
                                <div class="flex  border-b border-purple-800">
                                    <select
                                        class="@error('formation') is-invalid @enderror py-2  form-select mt-1 block w-full border-none shadow-none"
                                        name="formation">
                                        <option value="Formation longue" class="text-black" {{$etudiant->userinfos->formation == "Formation longue" ? 'selected': ''}}>Formation longue</option>
                                        <option value="Formation courte" class="text-black" {{$etudiant->userinfos->formation == "Formation courte" ? 'selected': ''}}>Formation courte</option>
                                        <option value="Evénement (workshop, Hackaton, etc)" class="text-black" {{$etudiant->userinfos->formation == "Evénement (workshop, Hackaton, etc)" ? 'selected': ''}}>
                                            Evénement(workshop, Hackaton, etc)</option>
                                    </select>
                                    @error('formation')
                                    <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                                <label for="statut" class="font-semibold text-gray-700 block pb-1">Statut</label>
                                <div class="flex  border-b border-purple-800">
                                    <select
                                        class="@error('statut') is-invalid @enderror py-2  form-select mt-1 block w-full border-none shadow-none"
                                        name="statut">
                                            <option value="demandeur d'emploi" class="text-black" {{$etudiant->userinfos->statut == "demandeur d'emploi"}}>Demandeur d'emploi</option>
                                            <option value="etudiant" class="text-black" {{$etudiant->userinfos->statut == "etudiant"}}>Etudiant</option>
                                            <option value="autre" class="text-black" {{$etudiant->userinfos->statut == "autre"}}>Autre</option>
                                    </select>
                                    @error('statut')
                                    <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="sm:flex pt-5">
                            {{-- email --}}
                            <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                                <label for="email" class="font-semibold text-gray-700 block pb-1">Email</label>
                                <div class="flex  border-b border-purple-800">
                                    <input id="email" name="email" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                        value="{{$etudiant->email}}" />
                                </div>
                            </div>
                            {{-- tel --}}
                            <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                                <label for="telephone" class="font-semibold text-gray-700 block pb-1">Telephone</label>
                                <div class="flex  border-b border-purple-800">
                                    <input id="telephone" name="telephone" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                        value="0{{$etudiant->telephone}}" />
                                </div>
                            </div>
                        </div>
                        <div class="sm:flex pt-5">
                            {{-- sexe --}}
                            <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                                <label for="sexe_id" class="font-semibold text-gray-700 block pb-1">Genre</label>
                                <div class="flex  border-b border-purple-800">
                                    <select
                                        class="@error('genre') is-invalid @enderror py-2  form-select mt-1 block w-full border-none shadow-none"
                                        name="genre">
                                            @foreach ($genres as $genre)
                                                <option value="{{$genre->id}}" class="text-black" {{$etudiant->sexe_id == $genre->id ? 'selected' : ""}}>{{$genre->nom}}</option>                                                
                                        @endforeach
                                    </select>
                                    @error('genre')
                                    <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- naissance --}}
                            <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                                <label for="naissance" class="font-semibold text-gray-700 block pb-1">Naissance</label>
                                <div class="flex  border-b border-purple-800">
                                    <input id="naissance" name="naissance" class="border-1  rounded-r px-4 py-2 w-full" type="date"
                                        value="{{$etudiant->naissance}}" />
                                </div>
                            </div>
                        </div>
                        <div class="sm:flex pt-5">
                            {{-- commune --}}
                            <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                                <label for="commune" class="font-semibold text-gray-700 block pb-1">Commune</label>
                                <div class="flex  border-b border-purple-800">
                                    <input id="commune" name="commune" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                        value="{{$etudiant->userinfos->commune}}" />
                                </div>
                            </div>
                            {{-- adresse --}}
                            <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                                <label for="adresse" class="font-semibold text-gray-700 block pb-1">Adresse</label>
                                <div class="flex  border-b border-purple-800">
                                    <input id="adresse" name="adresse" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                        value="{{$etudiant->userinfos->adresse}}" />
                                </div>
                            </div>
                        </div>
                        <div class="sm:flex pt-5">
                            {{-- objectif --}}
                            <div class="w-full sm:w-3/4 sm:pr-5 px-5">
                                <label for="objectif" class="font-semibold text-gray-700 block pb-1">Objectif</label>
                                <div class="flex  border-b border-purple-800">
                                    <textarea name="objectif" style="height:100px;resize:none" id="objectif"
                                        class="border-1  rounded-r px-4 py-2 w-full">{{$etudiant->userinfos->objectif}}</textarea>
                                </div>
                            </div>
                            {{-- pc --}}
                            <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5 flex flex-col">
                                <label for="pc" class="font-semibold text-gray-700 block pb-1">PC portable
                                    disponible</label>
                                <div class="flex  border-b border-purple-800">
                                    <select
                                    class="@error('formation') is-invalid @enderror py-2  form-select mt-1 block w-full border-none shadow-none"
                                    name="pc">
                                    <option value="0" class="text-black" {{$etudiant->userinfos->pc == '0' ? "selected" : ""}}>non</option>
                                    <option value="1" class="text-black" {{$etudiant->userinfos->pc == '1' ? "selected" : ""}}>oui</option>
                            </select>
                        </div>
                            </div>
                        </div>
                    </div>
            <div class="p-1  mt-2 text-center space-x-1 space-y-2">
                        <button type="submit"
                            class="bg-indigo-700 px-5 py-3 text-sm shadow-sm font-medium tracking-wider border text-indigo-100 rounded-full hover:shadow-lg hover:bg-indigo-800">Valider</button>
                    </div>
            </form>
        </div>
    </div>

</x-app-layout>
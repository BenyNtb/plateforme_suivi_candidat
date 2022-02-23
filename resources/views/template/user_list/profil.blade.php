<div class="border-b-2 border-purple-100 block md:flex">
    <div class="w-full bg-white lg:ml-4 ">
        <div class="rounded p-6">
            <div class="pb-6">
                <div class="sm:flex">
                    <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                        <label for="nom" class="font-semibold text-gray-700 block pb-1">Nom</label>
                        <div class="flex">
                            <input disabled id="nom" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{$etudiant->nom}}" />
                        </div>
                    </div>
                    {{-- prenom --}}
                    <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                        <label for="prenom" class="font-semibold text-gray-700 block pb-1">Prenom</label>
                        <div class="flex">
                            <input disabled id="prenom" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{$etudiant->prenom}}" />
                        </div>
                    </div>
                </div>
                <div class="sm:flex pt-5">
                    {{-- formation --}}
                    <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                        <label for="formation" class="font-semibold text-gray-700 block pb-1">Intérêt</label>
                        <div class="flex">
                            <input disabled id="formation" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{$etudiant->infos->formation}}" />
                        </div>
                    </div>
                    {{-- statut --}}
                    <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                        <label for="statut" class="font-semibold text-gray-700 block pb-1">Statut</label>
                        <div class="flex">
                            <input disabled id="statut" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{$etudiant->infos->statut}}" />
                        </div>
                    </div>
                </div>
                <div class="sm:flex pt-5">
                    {{-- email --}}
                    <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                        <label for="email" class="font-semibold text-gray-700 block pb-1">Email</label>
                        <div class="flex">
                            <input disabled id="email" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{$etudiant->email}}" />
                        </div>
                    </div>
                    {{-- tel --}}
                    <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                        <label for="telephone" class="font-semibold text-gray-700 block pb-1">Telephone</label>
                        <div class="flex">
                            <input disabled id="telephone" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="0{{$etudiant->telephone}}" />
                        </div>
                    </div>
                </div>
                <div class="sm:flex pt-5">
                    {{-- sexe --}}
                    <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                        <label for="sexe_id" class="font-semibold text-gray-700 block pb-1">Genre</label>
                        <div class="flex">
                            <input disabled id="sexe_id" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{$etudiant->sexe->nom}}" />
                        </div>
                    </div>
                    {{-- naissance --}}
                    <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                        <label for="naissance" class="font-semibold text-gray-700 block pb-1">Naissance</label>
                        <div class="flex">
                            <input disabled id="naissance" class="border-1  rounded-r px-4 py-2 w-full" type="date"
                                value="{{$etudiant->infos->date_naissance}}" />
                        </div>
                    </div>
                </div>
                <div class="sm:flex pt-5">
                    {{-- commune --}}
                    <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                        <label for="commune" class="font-semibold text-gray-700 block pb-1">Commune</label>
                        <div class="flex">
                            <input disabled id="commune" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{$etudiant->infos->commune}}" />
                        </div>
                    </div>
                    {{-- adresse --}}
                    <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                        <label for="adresse" class="font-semibold text-gray-700 block pb-1">Adresse</label>
                        <div class="flex">
                            <input disabled id="adresse" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{$etudiant->infos->adresse}}" />
                        </div>
                    </div>
                </div>
                <div class="sm:flex pt-5">
                    {{-- objectif --}}
                    <div class="w-full sm:w-3/4 sm:pr-5 px-5">
                        <label for="objectif" class="font-semibold text-gray-700 block pb-1">Objectif</label>
                        <div class="flex">
                            <textarea disabled style="height:100px;resize:none" id="objectif"
                                class="border-1  rounded-r px-4 py-2 w-full">{{$etudiant->infos->objectif}}</textarea>
                        </div>
                    </div>
                    {{-- pc --}}
                    <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5 flex flex-col justify-between">
                        <label for="pc" class="font-semibold text-gray-700 block pb-1">PC portable disponible</label>
                        <div class="flex w-full">
                            <input disabled id="pc" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                            @if ($etudiant->infos->pc == 1)
                            value="oui" 
                            @else
                            value="non" 
                            @endif    
                            />

                        </div>
                        <div class="w-full flex justify-end">
                            <a href="{{ route('etudiant.edit', $etudiant->id) }}" class=""><button
                                class="€bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-500 hover:border-indigo-600 hover:bg-indigo-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                                    class="fas fa-edit"></i>Edit</button></a>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('template.user_list.user_mail')
@include('template.user_list.formulaire')
@include('template.user_list.parcours')
@include('template.user_list.commentaire')
</div>
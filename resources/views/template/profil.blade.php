div    <div class="flex justify-between">
        <h2 class="text-4xl">Profil :{{ ucfirst(Auth::user()->nom)}} {{ ucfirst(Auth::user()->prenom)  }}  </h2>
        <a href="{{ route('profil.edit', Auth::user()->id) }}"><button
                class="bg-white text-gray-800 font-bold rounded border-b-2 border-purple-700 hover:border-purple-900 hover:bg-purple-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                    class="fas fa-user-edit pr-5"></i>Editer</button></a>
    </div>
    <div class=" block md:flex">
        <div class="w-full bg-white lg:ml-4 ">
            <div class="rounded p-6">
                <div class="pb-6">
                    <div class="sm:flex">
                        <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                            <label for="nom" class="font-semibold text-gray-700 block pb-1">Nom</label>
                            <div class="flex">
                                <input disabled id="nom" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                    value="{{ Auth::user()->nom }}" />
                            </div>
                        </div>
                        {{-- prenom --}}
                        <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                            <label for="prenom" class="font-semibold text-gray-700 block pb-1">Prenom</label>
                            <div class="flex">
                                <input disabled id="prenom" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                    value="{{ Auth::user()->prenom }}" />
                            </div>
                        </div>
                    </div>
                    <div class="sm:flex pt-5">
                        {{-- email --}}
                        <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                            <label for="email" class="font-semibold text-gray-700 block pb-1">Email</label>
                            <div class="flex">
                                <input disabled id="email" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                    value="{{ Auth::user()->email }}" />
                            </div>
                        </div>
                        {{-- tel --}}
                        <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                            <label for="telephone" class="font-semibold text-gray-700 block pb-1">Telephone</label>
                            <div class="flex">
                                <input disabled id="telephone" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                    value="0{{ Auth::user()->telephone }}" />
                            </div>
                        </div>
                    </div>
                    <div class="sm:flex pt-5">
                        {{-- sexe --}}
                        <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                            <label for="sexe_id" class="font-semibold text-gray-700 block pb-1">Genre</label>
                            <div class="flex">
                                <input disabled id="sexe_id" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                    value="{{ Auth::user()->genre->nom }}" />
                            </div>
                        </div>
                        {{-- naissance --}}
                        <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                            <label for="naissance" class="font-semibold text-gray-700 block pb-1">Naissance</label>
                            <div class="flex">
                                <input disabled id="naissance" class="border-1  rounded-r px-4 py-2 w-full" type="date"
                                    value="{{ Auth::user()->infos->date_naissance }}" />
                                </div>
                        </div>
                    </div>
                    <div class="sm:flex pt-5">
                        <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                            <label for="formation" class="font-semibold text-gray-700 block pb-1">Intérêt</label>
                            {{-- <div class="flex">
                                <input disabled id="formation" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                    value="{{ Auth::user()->userinfos->formation }}" />
                            </div> --}}
                        </div>
                        {{-- statut --}}
                        <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                            <label for="statut" class="font-semibold text-gray-700 block pb-1">Statut</label>
                            <div class="flex">
                                <input disabled id="statut" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                    value="{{ Auth::user()->infos->statut }}" />
                            </div>
                        </div>
                    </div>

                    <div class="sm:flex pt-5">
                        {{-- commune --}}
                        <div class="w-full sm:w-2/4 sm:pr-5 px-5">
                            <label for="commune" class="font-semibold text-gray-700 block pb-1">Commune</label>
                            <div class="flex">
                                <input disabled id="commune" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{ Auth::user()->infos->commune }}" />
                            </div>
                        </div>
                        {{-- adresse --}}
                        <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                            <label for="adresse" class="font-semibold text-gray-700 block pb-1">Adresse</label>
                            <div class="flex">
                                <input disabled id="adresse" class="border-1  rounded-r px-4 py-2 w-full" type="text"
                                value="{{ Auth::user()->infos->adresse }}" />
                            </div>
                        </div>
                    </div>
                    <div class="sm:flex pt-5">
                        {{-- pc --}}
                        <div class="w-full sm:w-2/4 sm:pl-5 px-5 sm:pt-0 pt-5">
                            <label for="pc" class="font-semibold text-gray-700 block pb-1">PC portable
                                disponible</label>
                            <div class="flex">
                                <input disabled id="pc" class="border-1  rounded-r px-4 py-2 w-full" type="text" @if (Auth::user()->infos->pc == 1) value="oui" 
                            @else
                                value="non" @endif />
                            </div>
                        </div>
                    </div>
                    <div class="pl-5 pt-5 w-full">
                        <label for="objectif" class="font-semibold text-gray-700 block pb-1">Objectif</label>
                        <div class="flex">
                            <textarea disabled style="height:100px;resize:none" id="objectif"
                                class="border-1  rounded-r px-4 py-2 w-full">{{ Auth::user()->infos->objectif }}</textarea>
                        </div>
                    </div>npm
                </div>
            </div>
        </div>
    </div>

<x-guest-layout>
    <div>
        <div class="lg:flex">
            <div class="lg:w-5/12 p-10 sm:px-32">
                <a href="https://molengeek.com/">
                    <h2 class="p-0 sm:mb-10  mb-3 uppercase font-bold text-xl text-purple-800">Molengeek</h2>
                </a>
                <h2 class="p-0  uppercase font-bold sm:text-5xl text-4xl leading-tight
                ">Inscrivez-vous et Ayez Accès a nos événements
                </h2>
                <img class="img_register" src="{{asset('img/working.png')}}" alt="">
            </div>
            <div class="lg:w-7/12 px-10 sm:px-32 my-auto">
                <h2 class="p-0 sm:mb-10  mb-0 lowercase text-sm text-purple-200">* Champs obligatoires</h2>
                <form method="POST" action="{{ route('register',$seance->id) }}">
                    @csrf
                    <div class="flex  sm:mb-8 mb-3">
                        <!-- Nom -->
                        <div class="w-2/4 mr-5  border-b border-purple-800">
                            <x-label for="nom" />
                            <x-input id="nom" class="@error('nom') is-invalid @enderror 
                            block mt-1 w-full border-none shadow-none placeholder-purple-300" type="text" name="nom"
                                :value="old('nom')" placeholder="Nom *" required autofocus />
                            @error('nom')
                            <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- Prenom -->
                        <div class="w-2/4 ml-5 border-b border-purple-800">
                            <x-label for="prenom" />
                            <x-input id="prenom"
                                class="@error('prenom') is-invalid @enderror block mt-1 w-full border-none shadow-none placeholder-purple-300"
                                type="text" name="prenom" placeholder="Prenom *" :value="old('prenom')" required
                                autofocus />
                            @error('prenom')
                            <span class="feedback-invalid text-xs text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex  sm:mb-8 mb-3">
                        <div class="w-2/4  mr-5  border-b border-purple-800">
                            <!-- intérêt -->
                            <x-label for="formation" />
                            <select class="@error('formation') is-invalid @enderror form-select mt-1 block w-full border-none shadow-none text-purple-300" name="formation">
                                <option disabled selected class="">Entrez vos intérêt *</option>
                                <option value="Formation longue" class="text-black">Formation longue</option>
                                <option value="Formation courte"  class="text-black">Formation courte</option>
                                <option value="Evénement (workshop, Hackaton, etc)" class="text-black">Evénement (workshop, Hackaton, etc)</option>
                            </select>
                            @error('formation')
                            <span class="feedback-invalid text-xs text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="w-2/4  ml-5  border-b border-purple-800">
                            <!-- intérêt -->
                            <x-label for="statut" />
                            <select class="@error('statut') is-invalid @enderror form-select mt-1 block w-full border-none shadow-none text-purple-300" name="statut">
                                <option disabled selected value='3' class="">Entrez votre statut *</option>
                                <option value="demandeur d'emploi" class="text-black">Demandeur d'emploi</option>
                                <option value="etudiant" class="text-black">Etudiant</option>
                                <option value="autre" class="text-black">Autre</option>
                            </select>
                            @error('statut')
                            <span class="feedback-invalid text-xs text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:flex  sm:mb-8 mb-3">
                        <!-- Email Address -->
                        <div class="w-4/4 sm:w-2/4 sm:mr-5 border-b border-purple-800 sm:mb-0 mb-3">
                            <x-label for="email" />
                            <x-input id="email"
                                class="@error('email') is-invalid @enderror  block mt-1 w-full border-none shadow-none placeholder-purple-300"
                                type="email" name="email" placeholder="Email *" :value="old('email')" required />
                            @error('email')
                            <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- genre -->
                        <div class="w-4/4 sm:w-2/4 sm:ml-5 border-b border-purple-800 sm:mb-0 mb-3">
                            <x-label for="genre"/>
                            <select class="@error("genre") is-invalid @enderror form-select mt-1 block w-full border-none shadow-none text-purple-300" name="genre">
                                <option disabled selected value='3' class="">Entrez votre genre *</option>
                                @foreach ($genres as $genre)
                                <option  value="{{$genre->id}}" class="text-black">{{$genre->nom}}</option>
                                @endforeach
                            </select>
                            @error('genre')
                            <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex  sm:mb-8 mb-3">
                        <!-- telephone -->
                        <div class="w-2/4 mr-5  border-b border-purple-800">
                            <x-label for="telephone" />
                            <x-input id="telephone"
                                class="@error('telephone') is-invalid @enderror block mt-1 w-full border-none shadow-none placeholder-purple-300"
                                type="text" name="telephone" placeholder="Telephone *" :value="old('telephone')"
                                required />
                            @error('telephone')
                            <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- Date -->
                        <div class="w-2/4 ml-5 border-b border-purple-800">
                            <x-label for="naissance" />
                            <x-input id="naissance"
                                class="@error('naissance') is-invalid @enderror block mt-1 w-full border-none shadow-none placeholder-purple-300"
                                onfocus="(this.type='date'),(this.value='0000-00-00')" type="text" name="naissance"
                                placeholder="Date De Naissance *" :value="old('naissance')" required />
                            @error('naissance')
                            <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex  sm:mb-8 mb-3">
                        <!-- commune -->
                        <div class="w-2/4 mr-5  border-b border-purple-800">
                            <x-label for="commune" />
                            <x-input id="commune" class="@error('commune') is-invalid @enderror 
                            block mt-1 w-full border-none shadow-none placeholder-purple-300" type="text"
                                name="commune" :value="old('commune')" placeholder="Commune *" required autofocus />
                            @error('commune')
                            <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- adresse -->
                        <div class="w-2/4 ml-5 border-b border-purple-800">
                            <x-label for="adresse" />
                            <x-input id="adresse"
                                class="@error('adresse') is-invalid @enderror block mt-1 w-full border-none shadow-none placeholder-purple-300"
                                type="text" name="adresse" placeholder="Adresse *" :value="old('adresse')" required
                                autofocus />
                            @error('adresse')
                            <span class="feedback-invalid text-xs text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="w-2/4 ml-5 border-b border-purple-800">
                            <x-label for="parcours" />
                            <x-input id="parcours"
                                class="@error('parcours') is-invalid @enderror block mt-1 w-full border-none shadow-none placeholder-purple-300"
                                type="text" name="parcours" placeholder="parcours *" :value="old('parcours')" required
                                autofocus />
                            @error('parcours')
                            <span class="feedback-invalid text-xs text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex  sm:mb-8 mb-3">
                    </div>
                    <div class="flex  sm:mb-8 mb-3">
                        <!-- textarea -->
                        <div class="w-3/4 border-b border-purple-800">
                            <label class="text-purple-300">Objectif *</label>
                            <textarea class="w-full" id="objectif" name="objectif"
                                style="height: 50px;resize: none; border:none">{{ old('objectif') }}</textarea>
                        </div>
                        <!-- pc dispo -->
                        <div class="w-1/4  ml-5  border-b border-purple-800">
                            <!-- intérêt -->
                            <x-label for="pc" />
                            <select class="@error('pc') is-invalid @enderror form-select mt-1 block w-full border-none shadow-none text-purple-300"  id ='pc' name="pc">
                                <option disabled selected value='3' class="">Pc disponible *</option>
                                <option  value="1" class="text-black">oui</option>
                                <option  value="0" class="text-black">non</option>
                            </select>
                            @error('pc')
                            <span class="feedback-invalid text-xs text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex  sm:mb-8 mb-3">
                        <!-- Password -->
                        <div class="w-2/4 mr-5 border-b border-purple-800">
                            <x-label for="password" />
                            <x-input id="password"
                                class="@error('password') is-invalid @enderror block mt-1 w-full border-none shadow-none placeholder-purple-300"
                                type="password" name="password" placeholder="Mot De Passe *" required
                                autocomplete="new-password" />
                            @error('password')
                            <span class="feedback-invalid text-xs  text-red-700">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- Confirm Password -->
                        <div class="w-2/4 ml-5 border-b border-purple-800">
                            <x-label for="password_confirmation" />

                            <x-input id="password_confirmation"
                                class="block mt-1 w-full border-none shadow-none placeholder-purple-300"
                                placeholder="Confirmation Mot De Passe *" type="password" name="password_confirmation"
                                required />
                        </div>

                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class="">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('loginSeance', $seance->id) }}">
                                {{ __('Déjà un compte ?') }}
                            </a>
                            <x-button class="ml-5 px-10 py-5  bg-gradient-to-r from-purple-800 to-purple-900 ">
                                {{ __('Se connecter') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

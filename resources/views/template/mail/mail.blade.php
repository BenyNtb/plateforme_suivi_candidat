<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            @if (Auth::user()->signature != null)
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sujet
                            </th>
                            @if ($route == "mail.student.index" || $route == "mail.search.student")
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dernier Envoie
                            </th>
                            @endif
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($route == "mail.student.index" || $route == "mail.search.student")
                        @foreach ($emails->where('basique',0) as $email)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <div x-data="{ showModal : false }">
                                        <!-- Button -->
                                        @if ($email->basique == true) 
                                        <p class="cursor-pointer" @click="showModal = !showModal">
                                        <i class="fas fa-lock"></i>{{$email->nom}}</p>
                                        @else
                                        <p class="cursor-pointer" @click="showModal = !showModal">{{$email->nom}}</p>    
                                        @endif 
                                        <!-- Modal Background -->
                                        <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                            <!-- Modal -->
                                            <div x-show="showModal" class="bg-white rounded-xl shadow-2xl p-6 sm:w-10/12 mx-10" @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                                                <!-- Title -->
                                                <span class="font-bold block text-2xl mb-3">{{$email->sujet}}</span><hr>
                                                <p class="mb-5">{!! $email->contenu !!}</p>
                                                <!-- Buttons -->
                                                <div class="text-right space-x-5 mt-5">
                                                    <button @click="showModal = !showModal" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-xs text-gray-900">
                                    {{ $email->sujet }}
                                </span>
                            </td>
                            @if ($route == "mail.student.index" || $route == "mail.search.student")
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                $histo_mails = App\Models\Boitemail::all()->where('id_envoie',$etudiant->id)->where('template_id',$email->id)->last();
                                $last_send =$histo_mails;
                                @endphp
                                <span class="text-xs text-gray-900">
                                    @if ($last_send != null)
                                    {{ date('d M Y', strtotime($last_send->created_at)) }}
                                    @else
                                    @endif
                                </span>
                            </td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if ($route == "mail.student.index" || $route == "mail.search.student")
                                @else
                                <a href="{{route('mail.edit', $email->id)}}"><button
                                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-purple-700 hover:border-purple-900 hover:bg-purple-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Edit
                                    </button></a>
                                @endif
                                @if ($route == "mail.student.index" || $route == "mail.search.student")
                                @if ($email->basique == true)
                                @else
                                <a href="{{route('mail.student.write', [$email->id,$etudiant->id])}}"><button
                                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-400 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Envoyer
                                        à {{$etudiant->nom}} {{$etudiant->prenom}}</button></a>
                                @endif
                                @else
                                @if ($email->basique == true)
                                @else
                                <a href="{{route('mail.write', $email->id)}}"><button
                                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-400 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Envoyer</button></a>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        @foreach ($emails as $email)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 flex">
                                    <div x-data="{ showModal : false }">
                                        <!-- Button -->
                                        @if ($email->basique == true) 
                                        <p class="cursor-pointer" @click="showModal = !showModal">
                                        <i class="fas fa-lock"></i>{{$email->nom}}</p>
                                        @else
                                        <p class="cursor-pointer" @click="showModal = !showModal">{{$email->nom}}</p>    
                                        @endif 
                                        <!-- Modal Background -->
                                        <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                            <!-- Modal -->
                                            <div x-show="showModal" class="bg-white rounded-xl shadow-2xl p-6 sm:w-10/12 mx-10" @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                                                <!-- Title -->
                                                <span class="font-bold block text-2xl mb-3">{{$email->sujet}}</span><hr>
                                                <p class="mb-5">{!! $email->contenu !!}</p>
                                                <!-- Buttons -->
                                                <div class="text-right space-x-5 mt-5">
                                                    <button @click="showModal = !showModal" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-xs text-gray-900">
                                    {{ $email->sujet }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if ($route == "mail.student.index" || $route == "mail.search.student")
                                @else
                                <a href="{{route('mail.edit', $email->id)}}"><button
                                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-purple-700 hover:border-purple-900 hover:bg-purple-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Edit
                                    </button></a>
                                @endif
                                @if ($route == "mail.student.index" || $route == "mail.search.student")
                                @if ($email->basique == true)
                                @else
                                <a href="{{route('mail.student.write', [$email->id,$etudiant->id])}}"><button
                                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-400 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Envoyer
                                        à {{$etudiant->nom}} {{$etudiant->prenom}}</button></a>
                                @endif
                                @else
                                @if ($email->basique == true)
                                @else
                                <a href="{{route('mail.write', $email->id)}}"><button
                                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-400 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Envoyer</button></a>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        <!-- More people... -->
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center">
                <h2 class="text-6xl text-center  text-gray-400">Créer votre signature</h2>
                <a href="{{route('mail.signature.create', Auth::user()->id)}}"><button
                        class="mt-5 text-3xl justify-center bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-700 hover:border-indigo-900 hover:bg-indigo-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Ma
                        signature</button></a>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="mx-auto flex justify-center mt-5">
    {{$emails->links('vendor.pagination.simple-tailwind')}}
</div>

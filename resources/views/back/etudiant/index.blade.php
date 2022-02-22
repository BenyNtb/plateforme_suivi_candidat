<x-app-layout>
    @include('template.user_list.nav')
    @include('layouts.flash')
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
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
                                    Stade
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($etudiants as $etudiant)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $etudiant->nom }} {{ $etudiant->prenom }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @foreach ($etudiant->inscrits->where('etape_id',2) as $test)
                                        <Span class="text-gray-600">{{ $test->etape->nom }}</Span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($etudiant->role->id)
                                    @case(3)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $etudiant->role->nom }}
                                    </span>
                                    @break
                                    @case(4)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $etudiant->role->nom }}
                                    </span>
                                    @break
                                    @case(2)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ $etudiant->role->nom }}
                                    </span>
                                    @break
                                    @case(1)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        {{ $etudiant->role->nom }}
                                    </span>
                                    @break
                                    @default
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @admin
                                    <a href="{{ route('etudiant.edit', $etudiant->id) }}"><button
                                            class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-500 hover:border-indigo-600 hover:bg-indigo-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                                                class="fas fa-edit pr-5"></i>Edit</button></a>
                                    @endadmin           
                                    <a href="{{ route('etudiant.show', $etudiant->id) }}"><button
                                            class="mx-3 bg-white text-gray-800 font-bold rounded border-b-2 border-purple-500 hover:border-purple-600 hover:bg-purple-600 hover:text-white shadow-md py-2 px-6 inline-flex items-center"><i
                                                class="fas fa-eye pr-5"></i>Voir</button></a>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto flex justify-center mt-5">
        {{$etudiants->links('vendor.pagination.simple-tailwind')}}
    </div>
</x-app-layout>
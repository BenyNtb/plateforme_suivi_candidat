<div class="flex mb-5 justify-between">
    <div class="flex w-4/12 justify-between">
        @switch($current_view)
            @case('all')
            <button class="text-rigth bg-white text-white font-bold rounded border-b-2 border-purple-600 bg-purple-500 shadow-md py-2 px-6 inline-flex items-center">ALL</button>
            <a href="{{ route('etudiant.index_candidat') }}">        <button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">CANDIDAT</button>
            </a>
            <a href="{{ route('etudiant.index_etudiant') }}">        <button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">ETUDIANT</button>
            </a>
                @break
                @case('candidat')
                <a href="{{ route('etudiant.index') }}">        <button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">ALL</button>
                </a>
                <button class="text-rigth bg-white text-white font-bold rounded border-b-2 border-purple-600 bg-purple-500 shadow-md py-2 px-6 inline-flex items-center">CANDIDAT</button>
                <a href="{{ route('etudiant.index_etudiant') }}">        <button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">ETUDIANT</button>
                </a>
                @break
                @case('etudiant')
                <a href="{{ route('etudiant.index') }}">        <button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">ALL</button>
                </a>
                <a href="{{ route('etudiant.index_candidat') }}">        <button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">CANDIDAT</button>
                </a>
                <button class="text-rigth bg-white text-white font-bold rounded border-b-2 border-purple-600 bg-purple-500 shadow-md py-2 px-6 inline-flex items-center">ETUDIANT</button>

                @break
                @case('recherche')
                <a href="{{ route('etudiant.index') }}">        <button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">ALL</button>
                </a>
                <a href="{{ route('etudiant.index_candidat') }}">        <button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">CANDIDAT</button>
                </a>
                <a href="{{ route('etudiant.index_etudiant') }}">        <button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">ETUDIANT</button>
                </a>

                @break
                    @default
                
        @endswitch

    </div>
    @if ($current_view == 'recherche')
    <div  class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-purple-500 shadow-md inline-flex">
    @else
    <div  class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 shadow-md inline-flex">
    @endif
        <form action="{{route('search')}}" class="search-form flex" >
            <input type="text" placeholder="Search" name="search" value="{{$recherche}}" class="pl-5">
            <button class="px-3 pr-5">Go</button>
        </form>    
    </div>
</div>
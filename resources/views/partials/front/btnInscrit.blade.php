@if(Auth::guard('candidat')->user())
@php
    $seance_inscrit =  Auth::user()->inscrits;
    @endphp
    @if ($seance_inscrit->contains('seance_id', $seance->id)) 
    <a
    class="opacity-75  mt-3 bg-purple-600 bg-opacity-90  text-sm font-bold py-6 px-8 rounded inline-flex items-center">
        <span class="text-base">déjà inscrit!</span>
    </a>
    @else
    <form action="{{route('inscription', $seance->id)}}" method="post" >
        @csrf
        <button
        type="submit" class="opacity-75 inline-flex items-center  mt-3 bg-gray-100 hover:bg-purple-600 bg-opacity-90 hover:text-white text-sm font-bold py-6 px-8 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-base">Inscris toi!</span>                                               
    </button>
    </form>
    @endif
@endif
@if(!Auth::guard('candidat')->user())
<a class="opacity-75  mt-3 bg-gray-100 hover:bg-purple-600 bg-opacity-90 hover:text-white text-sm font-bold py-6 px-8 rounded inline-flex items-center"
    href="{{ route('loginSeance', $seance->id) }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span class="text-base">Inscris toi!</span>
</a>
@endif

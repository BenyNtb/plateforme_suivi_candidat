@php
$url = url()->current();
$route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
@endphp
<div class="mb-5 flex justify-between">
    @if ($route == "mail.student.index" || $route == "mail.search.student")
    <h2 class="text-4xl">{{$etudiant->nom}} {{$etudiant->prenom}} mails</h2>
    @else
    <h2 class="text-4xl">Gestion des mails</h2>
    @endif
    @if ($route == "mail.student.index" || $route == "mail.search.student")
    <div  class="flex justify-end">
        {{-- <a href="{{route('mail.boitemail.student',$etudiant->id)}}"><button class="mx-2 bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-700 hover:border-indigo-900 hover:bg-indigo-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Historique</button></a> --}}
        <a href="{{route('newmail.write.student',$etudiant->id)}}"><button class="mx-2 bg-white text-gray-800 font-bold rounded border-b-2 border-green-700 hover:border-green-900 hover:bg-green-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Créer un Mail</button></a>
        <div  class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-purple-500 shadow-md inline-flex">
            <form action="{{route('mail.search.student',$etudiant->id)}}" class="search-form flex" >
                <input type="text" placeholder="Search" name="search" value="" class="pl-5">
                <button class="px-3 pr-5">Go</button>
            </form> 
        </div>
    </div>
    @else
    <div class="flex align-items ">
        @if (Auth::user()->signature != null)
        <a href="{{route('mail.boitemail')}}"><button class="mr-2 bg-white text-gray-800 font-bold rounded border-b-2 border-gray-700 hover:border-gray-900 hover:bg-gray-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Historique</button></a>
        <a href="{{route('mail.signature.create', Auth::user()->id)}}"><button class="mx-2 bg-white text-gray-800 font-bold rounded border-b-2 border-indigo-700 hover:border-indigo-900 hover:bg-indigo-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Ma signature</button></a>
        <a href="{{route('mail.create')}}"><button class="mx-2 bg-white text-gray-800 font-bold rounded border-b-2 border-purple-700 hover:border-purple-900 hover:bg-purple-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Créer un template</button></a>
        <a href="{{route('newmail.write')}}"><button class="mx-2 bg-white text-gray-800 font-bold rounded border-b-2 border-green-700 hover:border-green-900 hover:bg-green-700 hover:text-white shadow-md py-2 px-6 inline-flex items-center">Créer un Mail</button></a>
        <div  class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-purple-500 shadow-md inline-flex ml-2">
            <form action="{{route('mail.search')}}" class="search-form flex" >
                <input type="text" placeholder="Search" name="search" value="" class="pl-5">
                <button class="px-3 pr-5">Go</button>
            </form>    
        </div>    
        @endif
    </div>
    @endif
</div>
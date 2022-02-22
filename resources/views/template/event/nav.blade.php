@if ($pages == 'visible')
    <div class="flex flex-wrap space-x-3 space-y-2 items-center">
        @if ($view ==='all')
            <button class="text-right bg-white text-white font-bold rounded border-b-2 border-purple-600 bg-purple-500 shadow-md py-2 px-6 inline-flex items-center">All</button>
        @else
            <a href="{{ route('event.index') }}"><button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">All</button></a>
        @endif
        @foreach ($type_event as $item)
            @isset($item)
                @if ($view == $item->id)
                <button class="text-right bg-white text-white font-bold rounded border-b-2 border-purple-600 bg-purple-500 shadow-md py-2 px-6 inline-flex items-center">{{ ucfirst($item->nom) }}</button>
                @else
                    <a href="{{ route('event.index_tri',$item->id) }}"><button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">{{ ucfirst($item->nom) }}</button></a>
                @endif
            @endisset
        @endforeach
            <a href="{{route('event.create')}}" class="bg-green-600 text-white font-bold px-4 py-2 text-sm uppercase rounded tracking-wider focus:outline-none hover:bg-red-700">
                <i class="fas fa-plus"></i> Nouvel événement
            </a>
            <a href="{{route('event.archive')}}" class="bg-indigo-600 text-white font-bold px-4 py-2 text-sm uppercase rounded tracking-wider focus:outline-none hover:bg-red-700">
                <i class="fas fa-trash-alt"></i> Archives
            </a>
    </div>

@else
    <div class="flex flex-wrap space-x-3 space-y-2 items-center">
        @if ($view ==='all')
            <button class="text-right bg-white text-white font-bold rounded border-b-2 border-purple-600 bg-purple-500 shadow-md py-2 px-6 inline-flex items-center">All</button>
        @else
            <a href="{{ route('event.archive') }}"><button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">All</button></a>
        @endif
        @foreach ($type_event as $item)
                @if ($view == $item->id)
                    <button class="text-right bg-white text-white font-bold rounded border-b-2 border-purple-600 bg-purple-500 shadow-md py-2 px-6 inline-flex items-center">{{ ucfirst($item->nom) }}</button>
                @else
                    <a href="{{ route('event.archive_tri',$item->id) }}"><button class="text-rigth bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-500 hover:bg-green-400 hover:text-white shadow-md py-2 px-6 inline-flex items-center">{{ ucfirst($item->nom) }}</button></a>
                @endif
        @endforeach
        <a href="{{route('event.index')}}" class="bg-green-600 text-white font-bold px-4 py-2 text-sm uppercase rounded tracking-wider focus:outline-none hover:bg-red-700">
            <i class="fas fa-clock"></i> En cours
        </a>
    </div>

@endif


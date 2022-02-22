<div class="flex">
    <h2 class="text-xl">Envoyer un mail à </h2>
    <div class="flex">
        <x-label for="group" />
        <select id="firstselect" class=" mx-5 border-b-2" name="group" id="" class="mx-5">
            <option disabled selected>Selectionner une catégorie</option>
            <option value="1">Membre</option>
            <option value="2">Classe</option>
        </select>
    </div>
    @error('group')
    <span class="invalid-feedback text-red-600"><strong>Le champ catégorie est obligatoire</strong></span>
@enderror

    <div id="secondselect" class="flex  hidden">
        <x-label for="group_1" />
        <select   class=" mx-5 border-b-2" name="group_1" id="" class="mx-5">
            <option disabled selected>Selectionner des membres</option>
            <option value="all" class="">Tous les utilisateurs</option>
            @foreach ($roles as $item)
            <option value="{{$item->id}}">{{$item->nom}}</option>
            @endforeach
        </select>
    </div>
    <div id="thirdselect" class="flex hidden">
        <x-label for="group_2" />
        <select  class=" mx-5 border-b-2" name="group_2" id="" class="mx-5">
            <option disabled selected>Selectionner une classe</option>
            @forelse ($classes->where('etat',1) as $item)
            <option value="{{$item->id}}">{{$item->nom}}</option>
            @empty
            <option disabled>Aucune Classe dispo</option>                
            @endforelse
        </select>
    </div>
</div>

<script>
    let etape = document.querySelector('#firstselect');
    let select_1 = document.querySelector('#secondselect');
    let select_2 = document.querySelector('#thirdselect');
    etape.addEventListener('change', () => {
        const test = etape.value;
        if (test == '1') {
            select_1.classList.remove('hidden')
            select_2.classList.add('hidden')
        } else {
            select_1.classList.add('hidden')
            select_2.classList.remove('hidden')
        }
    })
</script>

<div>
    {{-- Be like water. --}}
    <p><strong>Filter Languages:</strong></p>
    <select
         type="text"
         class="p-4 border rounded-md bg-gray-700 text-white"
         wire:model.fill ="SelectedFilter"
         wire:change="ChangeFilter($event.target.value)"
    >
        <option value="All">All</option>
        
    @foreach($SupportedLanguages as $Language)
        <option value="{{$Language['Language']}}">{{$Language['Language']}}</option>
    @endforeach
    </select>
</div>

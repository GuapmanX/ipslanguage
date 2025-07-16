<x-layout :isadmin="$is_admin ?? false">
    <x-slot:heading>
        Translate percentage
    </x-slot:heading> 
    <x-slot:email>
        {{ $email }}
    </x-slot:email>

        @if ($is_admin)
            <livewire:LanguageFilter>
            <livewire:TranslateMenu default="All">
        @else
            <p class="text-xl"><strong>Language: {{ $Language }}</strong></p>
            <livewire:TranslateMenu default="{{$Language}}">
        @endif

</x-layout>

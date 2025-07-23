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
            @if(sizeof($Languages) > 1)
                <livewire:LanguageFilter>
            @else
                <p class="text-xl"><strong>Language: {{ $Languages[0] }}</strong></p>
            @endif

            <livewire:TranslateMenu default="{{ $Languages[0] }}">
        @endif

</x-layout>

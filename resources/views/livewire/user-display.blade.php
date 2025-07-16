<div>
    @foreach($users as $user)
        <div>
            <x-accordion>
                <x-slot:bgColor>
                    bg-white
                </x-slot:bgColor>
                
                <x-slot:language>
                    {{$user->name . ': ' . $user->selected_language}}
                </x-slot:language>

                <x-slot:percentage>
                        {{ $this->GetLanguagePercentage($user->selected_language) }}
                </x-slot:percentage>

                <x-slot:text>
                </x-slot:text>
            </x-accordion>
        </div>
    @endforeach
</div>

<div>
    @foreach ($Courses as $Course)
            <div>
                <x-accordion>
                        <x-slot:bgColor>
                        bg-white
                        </x-slot:bgColor>

                        <x-slot:language>
                            {{ $Course['Name'] }}
                            <x-edit-button href="/edit/Course/{{ $Course['id'] }}">edit</x-edit-button>
                        </x-slot:language>

                        <x-slot:percentage>
                                {{ $this->CalulateTranslateAverage($Course['TranslateData']) }}
                        </x-slot:percentage>

                        <x-slot:text>
                            @foreach ($Course['Children'] as $Module)
                                <div>
                                    <x-accordion>
                                            <x-slot:bgColor>
                                            bg-gray-200
                                            </x-slot:bgColor>

                                            <x-slot:language>
                                                {{ $Module['Name'] }}
                                                <x-edit-button href="/edit/Module/{{ $Module['id'] }}">edit</x-edit-button>
                                            </x-slot:language>

                                            <x-slot:percentage>
                                                    {{ $this->CalulateTranslateAverage($Module['TranslateData']) }}
                                            </x-slot:percentage>

                                            <x-slot:text>
                                                @foreach ($Module['Children'] as $Content)
                                                    <div>
                                                        <x-accordion>
                                                                <x-slot:bgColor>
                                                                bg-gray-300
                                                                </x-slot:bgColor>

                                                                <x-slot:language>
                                                                    {{ $Content['Name'] }}
                                                                    <x-edit-button href="/edit/Module/{{ $Content['id'] }}">edit</x-edit-button>
                                                                </x-slot:language>

                                                                <x-slot:percentage>
                                                                        {{ $this->CalulateTranslateAverage($Content['TranslateData']) }}
                                                                </x-slot:percentage>

                                                                <x-slot:text>
                                                                </x-slot:text>
                                                        </x-accordion>
                                                    </div>
                                                @endforeach
                                            </x-slot:text>
                                    </x-accordion>
                                </div>
                            @endforeach
                        </x-slot:text>
                </x-accordion>
            </div>
    @endforeach
</div>

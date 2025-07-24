<x-layout :isadmin="$is_admin ?? false">
    <x-slot:heading>
        Translate percentage
    </x-slot:heading> 
    <x-slot:email>
        {{ $email }}
    </x-slot:email>

            <p>Welcome to the editing section, editor</p>

            <form method="POST" action="/edit/{{ $translatable_type }}/{{ $translatable_id }}">
            @csrf

        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              
            @foreach ($english_values as $title)
                      <x-form-field>
                        <x-form-label>{{ $title }}</x-form-label>
                        <div class="mt-2">
                              <p>{{ $english_text[$title] }}</p>
                        </div>
                      </x-form-field>
            @endforeach
            
            @foreach ($translatables as $translatable)
                <x-form-field>
                  <x-form-label>{{ $translatable }}</x-form-label>

                  <div class="mt-2">
                        <x-form-input name="{{ $translatable }}" id="{{ $translatable }}" value="{{ $old_values[$translatable] }}" />
                        <x-form-error name="{{ $translatable }}"/>
                  </div>
              </x-form-field>
            @endforeach
            </div>
            

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="/" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
          <x-form-button>Save edits</x-form-button>
        </div>
        
      </form>

</x-layout>
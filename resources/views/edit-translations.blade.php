<x-layout :isadmin="$is_admin ?? false">
    <x-slot:heading>
        Translate percentage
    </x-slot:heading> 
    <x-slot:email>
        {{ $email }}
    </x-slot:email>

            <p>Welcome to the editing section, editor</p>

            <form method="POST" action="/edit">
            @csrf

            <input type="hidden" name="id" value="{{ $translatable_id }}">
            <input type="hidden" name="type" value="{{ $translatable_type }}">
            <input type="hidden" name="language" value="{{ $Language }}">

        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              

            
            @foreach ($translatables as $translatable)
                <x-form-field>
                  <x-form-label for="email">{{ $translatable }}</x-form-label>

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
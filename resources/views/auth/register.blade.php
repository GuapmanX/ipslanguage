<x-layout>
    <x-slot:heading>
        Register
    </x-slot:heading> 
    <form method="POST" action="/register">
    @csrf

        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              
              <x-form-field>
                  <x-form-label for="name">First Name</x-form-label>

                  <div class="mt-2">
                        <x-form-input name="name" id="name" required/>
                        <x-form-error name="name"/>
                  </div>
              </x-form-field>

              <x-form-field>
                  <x-form-label for="email">Email</x-form-label>

                  <div class="mt-2">
                          <x-form-input name="email" id="email" type="email" required/>
                          <x-form-error name="email"/>
                  </div>
              </x-form-field>

               <x-form-field>
                  <x-form-label for="password">Password</x-form-label>

                  <div class="mt-2">
                          <x-form-input name="password" id="password" type="password" required/>
                          <x-form-error name="password"/>
                  </div>
              </x-form-field>

              <x-form-field>
                  <x-form-label for="password_confirmation">Confirm Password</x-form-label>

                  <div class="mt-2">
                          <x-form-input name="password_confirmation" id="password_confirmation" type="password" required/>
                          <x-form-error name="password_confirmation"/>
                  </div>
              </x-form-field>

              <x-form-field>
                  <x-form-label for="selected_language">Select language</x-form-label>

                  <x-form-select name="selected_language" id="selected_language" type="text">
                                @foreach($SupportedLanguages as $Language)
                                    <option value="{{$Language['Language']}}">{{$Language['Language']}}</option>
                                @endforeach
                  </x-form-select>
              </x-form-field>

              <x-form-field>
                  <x-form-label for="is_admin">Would you like to be an admin?</x-form-label>
                            <input type="checkbox" id="is_admin" name="is_admin" value="true">
              </x-form-field>

          </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="/" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
          <x-form-button>Register</x-form-button>
        </div>
        
      </form>

</x-layout>
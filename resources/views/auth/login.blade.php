<x-guest-layout>

    <div class="flex flex-col justify-center min-h-full py-12 bg-gray-100 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
          <h2 class="mt-6 text-3xl font-bold tracking-tight text-center text-green-700">{{ __("Welcome back") }}</h2>
          <p class="mt-2 text-sm text-center">{{ __("Let's build something great") }}</p>
        </div>
      
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
          <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
    
                <x-frontend-form.form-group>
                    <x-slot:label>
                        <x-input-label for="email" value="{{ __('Email Address') }}"/>
                    </x-slot:label>
                    <x-frontend-form.input-text id="email" name="email" required/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </x-frontend-form.form-group>
    
                <x-frontend-form.form-group>
                    <x-slot:label>
                        <x-input-label for="password" value="{{ __('Password') }}"/>
                    </x-slot:label>
                    <x-frontend-form.input-text type="password" id="password" name="password" required/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </x-frontend-form.form-group>
    
      
              <x-frontend-form.button-primary>{{ __('Log in') }}</x-frontend-form.button-primary>
            </form>
          </div>
        </div>
      </div>
    
      
    </x-guest-layout>
    
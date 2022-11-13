<x-guest-layout>

<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-100">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-green-700">{{ __("Create your account") }}</h2>
      <p class="mt-2 text-center text-sm">{{ __("It's free and easy") }}</p>
    </div>
  
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            <x-frontend-form.form-group>
                <x-slot:label>
                    <x-input-label for="name" value="{{ __('Your Name') }}"/>
                </x-slot:label>
                <x-frontend-form.input-text id="name" name="name" placeholder="{{ __('Your Name') }}"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </x-frontend-form.form-group>

            <x-frontend-form.form-group>
                <x-slot:label>
                    <x-input-label for="email" value="{{ __('Email Address') }}"/>
                </x-slot:label>
                <x-frontend-form.input-text id="email" name="email" placeholder="{{ __('sample@company.com') }}"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </x-frontend-form.form-group>

            <x-frontend-form.form-group>
                <x-slot:label>
                    <x-input-label for="password" value="{{ __('Password') }}"/>
                </x-slot:label>
                <x-frontend-form.input-text id="password" name="password" placeholder=""/>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </x-frontend-form.form-group>

            <x-frontend-form.form-group>
                <x-slot:label>
                    <x-input-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                </x-slot:label>
                <x-frontend-form.input-text id="password_confirmation" name="password_confirmation" placeholder=""/>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </x-frontend-form.form-group>

            <div class="">
                <div class="flex items-start">
                  <input id="agree" name="agree" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                  <label for="agree" class="ml-2 block text-sm text-gray-900">
                      {{ __('By creating an account means you agree to the Terms and Conditions, and our Privacy Policy') }}
                  </label>
                </div>
              </div>

  
          <x-frontend-form.button-primary>{{ __('Register') }}</x-frontend-form.button-primary>
        </form>
  
        <div class="mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="bg-white px-2 text-gray-500">{{ __('Or do it via other accounts') }}</span>
            </div>
          </div>
  
          
          <section class="mt-8 flex justify-center gap-4 item-center">
              <a href="#">
                  <img src="{{ asset('img/icons/google.svg') }}" alt="" class="w-8 h-8">
              </a>
              <a href="#">
                <img src="{{ asset('img/icons/apple.svg') }}" alt="" class="w-8 h-8">
            </a>
            <a href="#">
                <img src="{{ asset('img/icons/facebook.svg') }}" alt="" class="w-8 h-8">
            </a>
          </section>

          <section class="mt-8">
              <p class="text-center">
                  <span>{{ __("Already registered? ") }}</span>
                  <a href="{{ route('login') }}" class="text-green-700 font-bold">{{ __("Log In") }}</a>
              </p>
          </section>

        </div>
      </div>
    </div>
  </div>

  
</x-guest-layout>

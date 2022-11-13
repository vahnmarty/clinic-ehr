<x-guest-layout>

    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-100">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
          <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-green-700">{{ __("Welcome back") }}</h2>
          <p class="mt-2 text-center text-sm">{{ __("Let's build something great") }}</p>
        </div>
      
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
          <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
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
                    <x-frontend-form.input-text id="password" name="password" required/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </x-frontend-form.form-group>
    
      
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
                      <span>{{ __("Forgot password? ") }}</span>
                      <a href="{{ route('password.request') }}" class="text-green-700 font-bold">{{ __("Reset Password") }}</a>
                  </p>
              </section>
    
            </div>
          </div>
        </div>
      </div>
    
      
    </x-guest-layout>
    
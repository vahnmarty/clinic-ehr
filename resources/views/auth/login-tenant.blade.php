<x-guest-layout>

    <div class="flex min-h-full">
        <div class="flex flex-col justify-center flex-1 px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="w-full max-w-sm mx-auto lg:w-96">
                <div>
                    <img class="w-auto h-12" src="{{ global_asset('img/logo.png') }}" alt="Your Company">
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">{{ $tenant->company }}</h2>

                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <form action="{{ route('login') }}" method="POST" class="space-y-6">
                            @csrf
                            <x-frontend-form.form-group>
                                <x-slot:label>
                                    <x-input-label for="email" value="{{ __('Email Address') }}" />
                                </x-slot:label>
                                <x-frontend-form.input-text id="email" name="email" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </x-frontend-form.form-group>

                            <x-frontend-form.form-group>
                                <x-slot:label>
                                    <x-input-label for="password" value="{{ __('Password') }}" />
                                </x-slot:label>
                                <x-frontend-form.input-text type="password" id="password" name="password" required />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </x-frontend-form.form-group>


                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox"
                                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label for="remember-me" class="block ml-2 text-sm text-gray-900">Remember
                                        me</label>
                                </div>

                                <div class="text-sm">
                                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot
                                        your password?</a>
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Sign
                                    in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative flex-1 hidden w-0 lg:block">
            <img class="absolute inset-0 object-cover w-full h-full" src="{{ global_asset('img/hero.jpg') }}"
                alt="">
        </div>
    </div>

    <div class="fixed bottom-0 left-0 right-0">
        @include('includes.footer')
    </div>


</x-guest-layout>

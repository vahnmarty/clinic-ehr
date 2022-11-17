<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Vital Signs') }}
    </h2>
</x-slot>

<div>
    <section>
        <header class="py-6 bg-gray-300">
            <div class="wrapper">
                <h1 class="text-xl font-bold">{{ __("Anthropometric Calculator") }}</h1>
            </div>
        </header>
        <div class="py-12 bg-gray-100">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-6">
                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Height') }} <x-required/>
                        </x-slot>
                        <x-form.input-group>
                            <x-form.input-text wire:model="height" required/>
                            <x-slot name="rightAddon">
                                <small>cm</small>
                            </x-slot>
                        </x-form.input-group>
                        <x-input-error :messages="$errors->get('height')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Weight') }} <x-required/>
                        </x-slot>
                        <x-form.input-group>
                            <x-form.input-text wire:model="weight" required/>
                            <x-slot name="rightAddon">
                                <small>kg</small>
                            </x-slot>
                        </x-form.input-group>
                        <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Head Circumference') }} <x-required/>
                        </x-slot>
                        <x-form.input-group>
                            <x-form.input-text wire:model="head_circumference" required/>
                            <x-slot name="rightAddon">
                                <small>kg</small>
                            </x-slot>
                        </x-form.input-group>
                        <x-input-error :messages="$errors->get('head_circumference')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Tricep Circumference') }} <x-required/>
                        </x-slot>
                        <x-form.input-group>
                            <x-form.input-text wire:model="tricep_circumference" required/>
                            <x-slot name="rightAddon">
                                <small>kg</small>
                            </x-slot>
                        </x-form.input-group>
                        <x-input-error :messages="$errors->get('tricep_circumference')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Edema') }} <x-required/>
                        </x-slot>
                        <div class="flex gap-4 py-2">
                            <label>
                                <input type="radio" wire:model="edema" value="1">
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" wire:model="edema" value="0">
                                <span>{{ __('No') }}</span>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('tricep_circumference')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Measured Recumbent') }} <x-required/>
                        </x-slot>
                        <div class="flex gap-4 py-2">
                            <label>
                                <input type="radio" wire:model="measured_recumbent" value="1">
                                <span>{{ __('Yes') }}</span>
                            </label>
                            <label>
                                <input type="radio" wire:model="measured_recumbent" value="0">
                                <span>{{ __('No') }}</span>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('tricep_circumference')" class="mt-2" />
                    </x-form.form-group>
                </div>
            </div>
        </div>
    </section>
    <section>
        <header class="py-6 bg-gray-300">
            <div class="wrapper">
                <h1 class="text-xl font-bold">{{ __("Results") }}</h1>
            </div>
        </header>
        <div class="py-6 bg-gray-100">
            <div class="pb-32 wrapper">

                <div class="grid gap-8 sm:grid-cols-2">
                    @foreach($results as $chunk)
                    <div class="space-y-8">
                        @foreach($chunk as $title => $widget)
                        <div class="flex justify-between gap-8 p-4 rounded-md shadow-sm bg-green-50">
                            <div class="flex-1"> 
                                <div class="flex justify-between mt-1">
                                    <label class="text-xs font-bold uppercase">{{ Str::title($title) }}</label>
                                    <div class="text-xs font-bold">{{ $widget['centile'] }}%</div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700 mt-4">
                                    <div class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500" style="width: {{ $widget['centile'] }}%"></div>
                                </div>
                            </div>
                            <div class="w-16">
                                <label class="text-xs font-bold uppercase">Z-Score</label>
                                <div class="p-2 mt-1 text-sm bg-white">{{ round($widget['value'],2) }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </section>
</div>
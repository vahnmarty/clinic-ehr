<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Vital Signs') }}
    </h2>
</x-slot>

<div>
    <section>
        <header class="py-6 bg-gray-300">
            <div class="wrapper">
                <h1 class="text-xl font-bold">{{ __("Patient") }}</h1>
            </div>
        </header>
        <div class="py-12 bg-gray-100">
            <div class="space-y-8 wrapper">
                <div class="grid grid-cols-4 gap-6">
                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('First Name') }}
                        </x-slot>
                        <x-form.input-text value="{{ $patient['first_name'] }}" readonly/>
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Last Name') }}
                        </x-slot>
                        <x-form.input-text value="{{ $patient['last_name'] }}" readonly/>
                    </x-form.form-group>                    
                </div>
            </div>
        </div>
    </section>
    <section>
        <header class="py-6 bg-gray-300">
            <div class="wrapper">
                <h1 class="text-xl font-bold">{{ __("Anthropometric Calculator") }}</h1>
            </div>
        </header>
        <div class="py-12 bg-gray-100">
            <div class="space-y-8 wrapper">
                <div class="grid grid-cols-4 gap-6">
                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Date of Birth') }} <x-required/>
                        </x-slot>
                        <x-form.input-text wire:model="date_of_birth" required class="bg-gray-200" readonly/>
                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Date of Visit') }} <x-required/>
                        </x-slot>
                        <x-form.input-text wire:model="date_of_visit" required class="bg-gray-200" readonly/>
                        <x-input-error :messages="$errors->get('date_of_visit')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Age (in days)') }} <x-required/>
                        </x-slot>
                        <x-form.input-text wire:model="age_in_days" required class="bg-gray-200" readonly/>
                        <x-input-error :messages="$errors->get('age_in_days')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('BMI') }} <x-required/>
                        </x-slot>
                        <x-form.input-text wire:model="bmi" required class="bg-gray-200" readonly/>
                        <x-input-error :messages="$errors->get('bmi')" class="mt-2" />
                    </x-form.form-group>
                </div>
                <div class="grid grid-cols-4 gap-6">

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
                            {{ __('MUAC') }} <x-required/>
                        </x-slot>
                        <x-form.input-group>
                            <x-form.input-text wire:model="muac" required/>
                            <x-slot name="rightAddon">
                                <small>cm</small>
                            </x-slot>
                        </x-form.input-group>
                        <x-input-error :messages="$errors->get('muac')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Tricep Skinfold') }} <x-required/>
                        </x-slot>
                        <x-form.input-group>
                            <x-form.input-text wire:model="tricep_skinfold" required/>
                            <x-slot name="rightAddon">
                                <small>mm</small>
                            </x-slot>
                        </x-form.input-group>
                        <x-input-error :messages="$errors->get('tricep_skinfold')" class="mt-2" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-slot name="label">
                            {{ __('Subscapular Skinfold') }} <x-required/>
                        </x-slot>
                        <x-form.input-group>
                            <x-form.input-text wire:model="subscapular_skinfold" required/>
                            <x-slot name="rightAddon">
                                <small>mm</small>
                            </x-slot>
                        </x-form.input-group>
                        <x-input-error :messages="$errors->get('subscapular_skinfold')" class="mt-2" />
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
            <div class="wrapper">

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

                <div class="flex justify-center mt-8">
                    <button type="button" class=" btn-secondary" wire:click="save">{{ __("Save Results") }}</button>
                </div>
                
            </div>
        </div>
    </section>

    <section>
        <header class="py-6 bg-gray-300">
            <div class="wrapper">
                <h1 class="text-xl font-bold">{{ __("Historical Vitals") }}</h1>
            </div>
        </header>
        <div class="py-6 bg-gray-100">
            <div class=" wrapper">

                <x-table.table-wrapper>
                    <thead class="bg-gray-50">
                        <tr>
                            <x-table.th class="text-center">
                                <input type="checkbox">
                            </x-table.th>
                            <x-table.th>{{ __('Date Collected') }}</x-table.th>
                            <x-table.th>{{ __('Height') }}</x-table.th>
                            <x-table.th>{{ __('Weight') }}</x-table.th>
                            <x-table.th>{{ __('HC') }}</x-table.th>
                            <x-table.th>{{ __('W/L') }}</x-table.th>
                            <x-table.th>{{ __('W/A') }}</x-table.th>
                            <x-table.th>{{ __('H/A') }}</x-table.th>
                            <x-table.th>{{ __('L/A') }}</x-table.th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ([] as $item)
                           
                        @endforeach
                    </tbody>
                   </x-table.table-wrapper>
                

                <div class="mt-8">
                    <button type="button" class="btn-secondary" wire:click="save">{{ __("Ready for Encounter") }}</button>
                </div>
                
            </div>
        </div>
    </section>
</div>
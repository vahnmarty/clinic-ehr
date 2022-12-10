<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Station 5: {{ __('Clinical Encounter') }}
    </h2>
    <x-slot name="rightHeader">
        <div x-data class="flex justify-end">
            <button type="button" class="btn-secondary" x-on:click="$dispatch('openmodal-search')">Search Patient</button>
        </div>
    </x-slot>
</x-slot>

<div class="py-12">
    <div class="wrapper">
        @if ($patient_id)
            @if ($patient)
                <div class="p-4 bg-white rounded-md">
                    <div class="flex">
                        <div class="w-20 h-20 overflow-hidden border-2 rounded-full shadow-lg">
                            <img src="{{ $patient->image_avatar }}" class="w-20 h-20" alt="">
                        </div>
                        <div class="pl-4">
                            <p>
                                <strong>Name: </strong>
                                <span>{{ $patient->first_name }} {{ $patient->last_name }}</span>
                            </p>
                            <p>
                                <strong>Birthday: </strong>
                                <span>{{ $patient->date_of_birth }}
                                    ({{ Carbon\Carbon::parse($patient->date_of_birth)->age }} yrs old) </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-3 space-y-4">
                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Chief Complaint') }} <x-required/>
                                </x-slot>
                                <x-form.input-text value="" placeholder="Chief Complaint" class="bg-white"/>
                                <x-input-error :messages="$errors->get('chief_complaint')" class="mt-2" />
                            </x-form.form-group>
                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('History of Illness') }} <x-required/>
                                </x-slot>
                                <textarea class="w-full bg-white border-gray-300 rounded-md" rows="6"></textarea>
                                <x-input-error :messages="$errors->get('history_illness')" class="mt-2" />
                            </x-form.form-group>
                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Physical Exam') }} <x-required/>
                                </x-slot>
                                <textarea class="w-full bg-white border-gray-300 rounded-md" rows="6"></textarea>
                                <x-input-error :messages="$errors->get('physical_exam')" class="mt-2" />
                            </x-form.form-group>
                        </div>
                        <div class="col-span-2 space-y-4">
                            <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
                                <header class="p-6">
                                    <h3 class="font-bold">{{ __('Vital Signs') }}</h3>
                                </header>
                                <div class="p-6">

                                </div>
                            </div>
                            <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
                                <header class="p-6">
                                    <h3 class="font-bold">{{ __('Medical Problems') }}</h3>
                                </header>
                                <div class="p-6">

                                </div>
                            </div>
                            <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
                                <header class="p-6">
                                    <h3 class="font-bold">{{ __('Current Treatment Plan') }}</h3>
                                </header>
                                <div class="p-6">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

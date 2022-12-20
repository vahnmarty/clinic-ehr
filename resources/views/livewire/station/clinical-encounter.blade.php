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
    <div class="space-y-8 wrapper">
        @if ($patient_id)
            @if ($patient)
                @include('livewire.station._patient', ['patient' => $patient])
                <div>
                    <div class="grid grid-cols-5 gap-12">
                        <div class="col-span-3">
                            <form wire:submit.prevent="prompt" id="formEncounter"
                                class="p-6 space-y-4 bg-white rounded-md">
                                <x-form.form-group>
                                    <x-slot name="label">
                                        {{ __('Chief Complaint') }}
                                        <x-required />
                                    </x-slot>
                                    <x-form.input-text wire:model.defer="chief_complaint" placeholder="Chief Complaint"
                                        class="bg-white" required />
                                    <x-input-error :messages="$errors->get('chief_complaint')" class="mt-2" />
                                </x-form.form-group>
                                <x-form.form-group>
                                    <x-slot name="label">
                                        {{ __('History of Illness') }}
                                        <x-required />
                                    </x-slot>
                                    <textarea wire:model.defer="illness_history" class="w-full bg-white border-gray-300 rounded-md" rows="6"></textarea>
                                    <x-input-error :messages="$errors->get('history_illness')" class="mt-2" />
                                </x-form.form-group>
                                <x-form.form-group>
                                    <x-slot name="label">
                                        {{ __('Physical Exam') }}
                                        <x-required />
                                    </x-slot>
                                    <textarea wire:model.defer="physical_exam" class="w-full bg-white border-gray-300 rounded-md" rows="6"></textarea>
                                    <x-input-error :messages="$errors->get('physical_exam')" class="mt-2" />
                                </x-form.form-group>
                            </form>
                        </div>
                        <div class="col-span-2 space-y-4">
                            <div>
                                <header class="mb-2">
                                    <h3 class="text-xl font-bold">{{ __('Vital Signs') }}</h3>
                                </header>
                                @if (!empty($vital_sign))
                                    <div class="divide-y">
                                        <x-description-list label="Height">
                                            {{ $vital_sign->height }} cm
                                        </x-description-list>
                                        <x-description-list label="Weight">
                                            {{ $vital_sign->weight }} kg
                                        </x-description-list>
                                        <x-description-list label="Height for Age">
                                            {{ $vital_sign->length_for_age }}
                                        </x-description-list>
                                        <x-description-list label="Weight for Age">
                                            {{ $vital_sign->weight_for_age }}
                                        </x-description-list>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <header class="mb-4">
                                    <h3 class="text-xl font-bold">{{ __('Medical Problems') }}</h3>
                                </header>
                                <table class="table w-full space-y-4 text-left">
                                    <thead>
                                        <tr>
                                            <th width="40%">Name</th>
                                            <th>Date of Diagnosis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patient->medicalProblems as $problem)
                                            <tr class="border-t">
                                                <td>{{ $problem->name }}</td>
                                                <td class="py-2">{{ $problem->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <header class="mb-4">
                                    <h3 class="text-xl font-bold">{{ __('Current Treatment Plan') }}</h3>
                                </header>
                                <table class="table w-full space-y-4 text-left">
                                    <thead>
                                        <tr>
                                            <th width="40%">Supplements</th>
                                            <th>Medications</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patient->medications as $medication)
                                            <tr class="border-t">
                                                <td>{{ $medication->supplements }}</td>
                                                <td class="py-2">{{ $medication->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">

                    <div class="p-8 bg-white rounded-md">
                        <h3 class="mb-8 text-xl font-bold text-gray-900">Assessment</h3>
                        <div class="grid grid-cols-2">
                            <div>
                                <x-form.form-group>
                                    <x-slot name="label">
                                        {{ __('Encounter Impression') }}
                                        <x-required />
                                    </x-slot>
                                    <textarea wire:model.defer="impression" form="formEncounter" class="w-full bg-white border-gray-300 rounded-md"
                                        rows="6"></textarea>
                                    <x-input-error :messages="$errors->get('encounter_impression')" class="mt-2" />
                                </x-form.form-group>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h4 class="mb-2 font-bold">Medical Coding</h4>
                            @livewire('station.assessment-medical-coding', ['patientId' => $patient_id])
                        </div>
                    </div>
                </div>


                <div class="p-8 bg-white rounded-md">
                    <h3 class="mb-8 text-xl font-bold text-gray-900">Plan</h3>
                    <div>
                        <h4 class="mb-2 font-bold">Medication</h4>

                        @livewire('station.encounter-medication', ['patientId' => $patient_id])
                    </div>
                    <div class="mt-8">
                        <h4 class="mb-2 font-bold">Laboratory</h4>

                        @livewire('station.encounter-laboratory', ['patientId' => $patient_id])
                    </div>
                </div>


                <div class="">
                    <div class="flex items-center justify-between px-6 py-4 bg-green-300 rounded-md">
                        <h3 class="text-xl font-bold text-gray-900">Sign Encounter</h3>
                        <button class="btn-secondary" type="submit" form="formEncounter">Sign Encounter</button>
                    </div>
                </div>

            @endif
        @endif
    </div>
</div>

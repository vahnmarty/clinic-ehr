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
                    <div class="grid grid-cols-5 gap-4">
                        <div class="col-span-3">
                            <form wire:submit.prevent="prompt" id="formEncounter" class="space-y-4">
                                <x-form.form-group>
                                    <x-slot name="label">
                                        {{ __('Chief Complaint') }} <x-required/>
                                    </x-slot>
                                    <x-form.input-text wire:model.defer="chief_complaint" placeholder="Chief Complaint" class="bg-white" required/>
                                    <x-input-error :messages="$errors->get('chief_complaint')" class="mt-2" />
                                </x-form.form-group>
                                <x-form.form-group>
                                    <x-slot name="label">
                                        {{ __('History of Illness') }} <x-required/>
                                    </x-slot>
                                    <textarea wire:model.defer="illness_history" class="w-full bg-white border-gray-300 rounded-md" rows="6"></textarea>
                                    <x-input-error :messages="$errors->get('history_illness')" class="mt-2" />
                                </x-form.form-group>
                                <x-form.form-group>
                                    <x-slot name="label">
                                        {{ __('Physical Exam') }} <x-required/>
                                    </x-slot>
                                    <textarea wire:model.defer="physical_exam" class="w-full bg-white border-gray-300 rounded-md" rows="6"></textarea>
                                    <x-input-error :messages="$errors->get('physical_exam')" class="mt-2" />
                                </x-form.form-group>
                            </form>
                        </div>
                        <div class="col-span-2 space-y-4">
                            <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
                                <header class="flex items-center justify-between px-6 py-4 pb-0">
                                    <h3 class="font-bold">{{ __('Vital Signs') }}</h3>
                                    @if( !empty($vital_sign) )
                                    <div class="flex items-center gap-2">
                                        <x-heroicon-o-clock class="w-5 h-5 text-gray-600" />
                                        <p class="text-sm">{{ $vital_sign->created_at->format('m/d/Y h:i a') }}</p>
                                    </div>
                                    @endif
                                </header>
                                @if(!empty($vital_sign))
                                <div class="grid grid-cols-2 gap-6 p-6">
                                    <div>
                                        <label>Height</label>
                                        <p class="font-bold">{{ $vital_sign->height }} cm</p>
                                    </div>
                                    <div>
                                        <label>Weight</label>
                                        <p class="font-bold">{{ $vital_sign->weight }} kg</p>
                                    </div>
                                    <div>
                                        <label>Height for Age</label>
                                        <p class="font-bold">{{ $vital_sign->length_for_age }}</p>
                                    </div>
                                    <div>
                                        <label>Weight for Age</label>
                                        <p class="font-bold">{{ $vital_sign->weight_for_age }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
                                <header class="p-6 py-4 pb-0">
                                    <h3 class="font-bold">{{ __('Medical Problems') }}</h3>
                                </header>
                                <div class="p-6">
                                    <table class="table w-full text-left">
                                        <thead>
                                            <tr>
                                                <th>Supplements</th>
                                                <th>Date of Diagnosis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($patient->medicalProblems as $problem)
                                            <tr>
                                                <td>{{ $problem->name }}</td>
                                                <td>{{ $problem->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="bg-white border border-gray-300 rounded-lg shadow-sm">
                                <header class="px-6 py-4 pb-0">
                                    <h3 class="font-bold">{{ __('Current Treatment Plan') }}</h3>
                                </header>
                                <div class="p-6">
                                    <table class="table w-full text-left">
                                        <thead>
                                            <tr>
                                                <th>Supplements</th>
                                                <th>Medications</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($patient->medications as $medication)
                                            <tr>
                                                <td></td>
                                                <td>{{ $medication->name }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-4 bg-gray-300">
                    <h3 class="text-xl font-bold text-gray-900">Assessment</h3>
                </div>
                <div>
                    <div class="grid grid-cols-2">
                        <div>
                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Encounter Impression') }} <x-required/>
                                </x-slot>
                                <textarea wire:model.defer="impression" form="formEncounter" class="w-full bg-white border-gray-300 rounded-md" rows="6"></textarea>
                                <x-input-error :messages="$errors->get('encounter_impression')" class="mt-2" />
                            </x-form.form-group>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h4 class="mb-2 font-bold">Medical Coding</h4>
                        @livewire('station.assessment-medical-coding', ['patientId' => $patient_id])
                    </div>
                </div>


                <div class="px-4 py-4 bg-gray-300">
                    <h3 class="text-xl font-bold text-gray-900">Plan</h3>
                </div>
                <div>
                    <h4 class="mb-2 font-bold">Medication</h4>

                    @livewire('station.encounter-medication', ['patientId' => $patient_id])
                </div>
                <div>
                    <h4 class="mb-2 font-bold">Laboratory</h4>

                    @livewire('station.encounter-laboratory', ['patientId' => $patient_id])
                </div>


                <div class="flex justify-between px-6 py-4 bg-green-300">
                    <h3 class="text-xl font-bold text-gray-900">Sign Encounter</h3>
                    <button class="btn-secondary" type="submit" form="formEncounter">Sign Encounter</button>
                </div>

            @endif
        @endif
    </div>
</div>

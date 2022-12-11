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
                <div>
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
                                    {{ __('Physical Exam') }} <x-required/>
                                </x-slot>
                                <textarea class="w-full bg-white border-gray-300 rounded-md" rows="6"></textarea>
                                <x-input-error :messages="$errors->get('physical_exam')" class="mt-2" />
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

            @endif
        @endif
    </div>
</div>

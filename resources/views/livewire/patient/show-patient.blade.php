<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Patient Chart') }}
    </h2>
</x-slot>

<x-slot name="rightHeader"> </x-slot>

<div class="py-6 space-y-8">

    <div class="py-3 wrapper">
        <div>
            <!-- Page header -->
            <div class="flex justify-between">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img class="w-16 h-16 rounded-full" src="{{ $patient->getAvatar() }}" alt="" />
                            <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            {{ $patient->getFullName() }}
                        </h1>
                        <div class="flex space-x-10">
                            <p class="text-sm font-medium text-gray-500">
                                Patient ID: {{ $patient->patient_number }}
                            </p>
                            <p class="text-sm font-medium text-gray-500">
                                DOB: {{ $patient->date_of_birth }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="self-center">

                    <nav aria-label="Progress">
                        <ol role="list" class="flex items-center">
                            <x-progress-item 
                                label="Check-in" 
                                link="{{ route('station.checkin', ['patientId' => $patient->id]) }}" 
                                :done="$app?->check_in_at ? true : false" />
                            <x-progress-item 
                                label="Vitals" 
                                link="{{ route('station.vital-sign', ['patientId' => $patient->id]) }}" 
                                :done="$app?->vital_sign_finished_at ? true : false" />

                            <x-progress-item 
                                label="Public Health" 
                                link="{{ route('station.research', ['patientId' => $patient->id]) }}" 
                                :done="$app?->research_form_finished_at ? true : false" />

                            <x-progress-item 
                                label="Encounter" 
                                link="{{ route('station.clinical-encounter', ['patientId' => $patient->id]) }}" 
                                :done="$app?->clinic_encounter_finished_at ? true : false" />

                            <x-progress-item 
                                label="Orders" 
                                link="{{ route('station.pharmacy-order', ['patientId' => $patient->id]) }}" 
                                :done="$app?->pharmacy_order_finished_at ? true : false"
                                :last="true" />
                                
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <div class="grid grid-cols-2 gap-8">
            <div class="p-4 bg-white rounded-md">
                <header class="flex items-start justify-between h-16 py-2">
                    <h3 class="text-xl font-bold">{{ __('Patient Information') }}</h3>
                    <div>
                        <a href="{{ route('station.patient-details', ['patientId' => $patient_id]) }}"
                            class="btn-primary">Edit</a>
                    </div>
                </header>
                <div>
                    <div class="py-6 border-t">
                        <dl class="divide-y">
                            <x-description-list label="Full Name">{{ $patient->getFullName() }}
                            </x-description-list>
                            <x-description-list label="Address">{{ $patient->getAddress() }}</x-description-list>

                            <x-description-list label="Email">{{ $patient->email }}
                            </x-description-list>
                            <x-description-list label="Phone">{{ $patient->cellphone }}</x-description-list>

                            <x-description-list label="DPI Number">{{ $patient->dpi_number }}
                            </x-description-list>
                            <x-description-list label="Identity">{{ $patient->identity?->description }}
                            </x-description-list>

                            <x-description-list label="Primary Language">
                                {{ $patient->primary_language?->description }}
                            </x-description-list>

                            <x-description-list label="Parent/Guardian">
                                @foreach ($patient->guardians as $guardian)
                                    <p>{{ $guardian->first_name }} {{ $guardian->last_name }}
                                        ({{ $guardian->parent_type?->description }})
                                    </p>
                                @endforeach
                            </x-description-list>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white rounded-md">
                <header class="h-16 py-2">
                    <h3 class="text-xl font-bold">{{ __('Medical History') }}</h3>
                </header>
                <div>
                    <div class="py-6 border-t">
                        <dl class="divide-y">
                            <x-description-list label="Medical Problems">
                                @foreach ($patient->medicalProblems as $medicalProblem)
                                    <p>{{ $medicalProblem->name }}</p>
                                @endforeach
                            </x-description-list>

                            <x-description-list label="Current Medications">
                                @foreach ($patient->medications as $medication)
                                    <p>{{ $medication->name }}</p>
                                @endforeach
                            </x-description-list>

                            <x-description-list label="Allergies">
                                @foreach ($patient->allergies as $allergy)
                                    <p>{{ $allergy->name }}</p>
                                @endforeach
                            </x-description-list>

                            <x-description-list label="Prenatal History">
                                @if ($patient->prenatal)
                                    <p>{{ $patient->prenatal->pregnancy_number }}</p>
                                @endif
                            </x-description-list>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 wrapper">
        <header>
            <h3 class="text-xl font-bold">{{ __('Application History') }}</h3>
        </header>
        <div class="px-2 py-2 mt-4 bg-white rounded-md">
            <x-table.table-wrapper>
                <thead class="bg-gray-100">
                    <tr>
                        <x-table.th>#</x-table.th>
                        <x-table.th>UUID</x-table.th>
                        <x-table.th>Visit Reason</x-table.th>
                        <x-table.th>Clinic</x-table.th>
                        <x-table.th>Date Started</x-table.th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <x-table.td>{{ $loop->index + 1 }}</x-table.td>
                            <x-table.td>{{ $application->getCode() }}</x-table.td>
                            <x-table.td>{{ $application->visit_reason }}</x-table.td>
                            <x-table.td>{{ $application->clinic->name }}</x-table.td>
                            <x-table.td>{{ $application->created_at->format('M d, Y') }}</x-table.td>
                        </tr>
                        <tr class="bg-indigo-100">
                            <x-table.th></x-table.th>
                            <x-table.th>Station</x-table.th>
                            <x-table.th>Status</x-table.th>
                            <x-table.th>Finished At</x-table.th>
                            <x-table.th>Created By</x-table.th>
                        </tr>
                        <tr>
                            <x-table.td></x-table.td>
                            <x-table.td> Check-in</x-table.td>
                            <x-table.td>
                                @if ($application->check_in_at)
                                    <x-heroicon-s-check-circle class="w-6 h-6 text-green-500" />
                                @else
                                    <x-heroicon-o-check-circle class="w-6 h-6 text-gray-300" />
                                @endif
                            </x-table.td>
                            <x-table.td>{{ $application->check_in_at?->format('M d, Y') }}</x-table.td>
                            <x-table.td>{{ $application->getUser($application->check_in_user_id) }}</x-table.td>
                        </tr>
                        <tr>
                            <x-table.td></x-table.td>
                            <x-table.td> Update Patient</x-table.td>
                            <x-table.td>
                                @if ($application->patient_info_finished_at)
                                    <x-heroicon-s-check-circle class="w-6 h-6 text-green-500" />
                                @else
                                    <x-heroicon-o-check-circle class="w-6 h-6 text-gray-300" />
                                @endif
                            </x-table.td>
                            <x-table.td>{{ $application->patient_info_finished_at?->format('M d, Y') }}</x-table.td>
                            <x-table.td>{{ $application->getUser($application->patient_info_user_id) }}</x-table.td>
                        </tr>
                        <tr>
                            <x-table.td></x-table.td>
                            <x-table.td> Vital Signs</x-table.td>
                            <x-table.td>
                                @if ($application->vital_sign_finished_at)
                                    <x-heroicon-s-check-circle class="w-6 h-6 text-green-500" />
                                @else
                                    <x-heroicon-o-check-circle class="w-6 h-6 text-gray-300" />
                                @endif
                            </x-table.td>
                            <x-table.td>{{ $application->vital_sign_finished_at?->format('M d, Y') }}</x-table.td>
                            <x-table.td>{{ $application->getUser($application->vital_sign_user_id) }}</x-table.td>
                        </tr>
                        <tr>
                            <x-table.td></x-table.td>
                            <x-table.td>Public Health</x-table.td>
                            <x-table.td>
                                @if ($application->research_form_finished_at)
                                    <x-heroicon-s-check-circle class="w-6 h-6 text-green-500" />
                                @else
                                    <x-heroicon-o-check-circle class="w-6 h-6 text-gray-300" />
                                @endif
                            </x-table.td>
                            <x-table.td>{{ $application->research_form_finished_at?->format('M d, Y') }}</x-table.td>
                            <x-table.td>{{ $application->getUser($application->research_form_user_id) }}</x-table.td>
                        </tr>
                        <tr>
                            <x-table.td></x-table.td>
                            <x-table.td>Clinical Encounter</x-table.td>
                            <x-table.td>
                                @if ($application->clinic_encounter_finished_at)
                                    <x-heroicon-s-check-circle class="w-6 h-6 text-green-500" />
                                @else
                                    <x-heroicon-o-check-circle class="w-6 h-6 text-gray-300" />
                                @endif
                            </x-table.td>
                            <x-table.td>{{ $application->clinic_encounter_finished_at?->format('M d, Y') }}
                            </x-table.td>
                            <x-table.td>{{ $application->getUser($application->clinic_encounter_user_id) }}
                            </x-table.td>
                        </tr>
                        <tr>
                            <x-table.td></x-table.td>
                            <x-table.td>Pharmacy Order</x-table.td>
                            <x-table.td>
                                @if ($application->pharmacy_order_finished_at)
                                    <x-heroicon-s-check-circle class="w-6 h-6 text-green-500" />
                                @else
                                    <x-heroicon-o-check-circle class="w-6 h-6 text-gray-300" />
                                @endif
                            </x-table.td>
                            <x-table.td>{{ $application->pharmacy_order_finished_at?->format('M d, Y') }}</x-table.td>
                            <x-table.td>{{ $application->getUser($application->pharmacy_order_user_id) }}</x-table.td>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table-wrapper>
        </div>
    </div>
    <div class="mt-8 wrapper">
        @livewire('patient.patient-clinical-encounter', ['patientId' => $patient_id])
    </div>

    <div class="mt-8 wrapper">
        @livewire('patient.vaccine-records', ['patientId' => $patient_id])
    </div>
</div>

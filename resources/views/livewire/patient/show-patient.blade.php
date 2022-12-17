<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Dashboard') }}
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
                            <x-progress-item label="Check-in" :done="$app->check_in_at ? true : false"/>
                            <x-progress-item label="Vitals" :done="$app->vital_sign_finished_at ? true : false"/>
                            <x-progress-item label="Public Health" :done="$app->research_form_finished_at ? true : false"/>
                            <x-progress-item label="Encounter" :done="$app->clinic_encounter_finished_at ? true : false"/>
                            <x-progress-item label="Orders" :done="$app->pharmacy_order_finished_at ? true : false" :last="true"/>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="text-gray-900 bg-white rounded-md wrapper">
        <header class="px-16 py-6">
            <h3 class="text-xl font-bold">{{ __('Patient Information') }}</h3>
        </header>
        <div class="px-16">
            <div class="py-6 border-t">
                <dl>
                    <x-description-list :striped="true" label="Full Name">{{ $patient->getFullName() }}
                    </x-description-list>
                    <x-description-list label="Address">{{ $patient->getAddress() }}</x-description-list>

                    <x-description-list :striped="true" label="Email">{{ $patient->email }}</x-description-list>
                    <x-description-list label="Phone">{{ $patient->cellphone }}</x-description-list>

                    <x-description-list :striped="true" label="DPI Number">{{ $patient->dpi_number }}
                    </x-description-list>
                    <x-description-list label="Identity">{{ $patient->identity->description }}</x-description-list>

                    <x-description-list :striped="true" label="Primary Language">{{ $patient->primary_language->description }}
                    </x-description-list>

                    <x-description-list :striped="false" label="Parent/Guardian">
                        @foreach($patient->guardians as $guardian)
                        <p>{{ $guardian->first_name }} {{ $guardian->last_name }} ({{ $guardian->parent_type->description }})</p>
                        @endforeach
                    </x-description-list>
                </dl>
            </div>
        </div>

        <header class="px-16 py-6">
            <h3 class="text-xl font-bold">{{ __('Medical History') }}</h3>
        </header>
        <div class="px-16">
            <div class="py-6 border-t">
                <dl>
                    <x-description-list :striped="true" label="Medical Problems">
                        @foreach($patient->medicalProblems as $medicalProblem)
                        <p>{{ $medicalProblem->name }}</p>
                        @endforeach
                    </x-description-list>

                    <x-description-list :striped="false" label="Current Medications">
                        @foreach($patient->medications as $medication)
                        <p>{{ $medication->name }}</p>
                        @endforeach
                    </x-description-list>

                    <x-description-list :striped="true" label="Allergies">
                        @foreach($patient->allergies as $allergy)
                        <p>{{ $allergy->name }}</p>
                        @endforeach
                    </x-description-list>

                    <x-description-list :striped="false" label="Prenatal History">
                        @if($patient->prenatal)
                        <p>{{ $patient->prenatal->pregnancy_number }}</p>
                        @endif
                    </x-description-list>

                    <x-description-list :striped="true" label="{{ __('Birth History') }}"></x-description-list>
                </dl>
            </div>
        </div>
    </div>
    <div class="mt-8 wrapper">
        @livewire('patient.patient-clinical-encounter')
    </div>

    <div class="mt-8 wrapper">
        @livewire('patient.vaccine-records', ['patientId' => $patient_id])
    </div>
</div>

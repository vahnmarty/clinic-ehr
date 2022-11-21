<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __("Dashboard") }}
    </h2>
</x-slot>

<x-slot name="rightHeader"> </x-slot>

<div class="py-12 space-y-8">
    <div class="wrapper">
        <div>
            <!-- Page header -->
            <div class="flex justify-between">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img
                                class="w-16 h-16 rounded-full"
                                src="{{ $patient->getAvatar() }}"
                                alt=""
                            />
                            <span
                                class="absolute inset-0 rounded-full shadow-inner"
                                aria-hidden="true"
                            ></span>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            {{ $patient->getFullName() }}
                        </h1>
                        <div class="flex space-x-10">
                            <p class="text-sm font-medium text-gray-500">
                                Patient ID: {{ $patient->patient_id }}
                            </p>
                            <p class="text-sm font-medium text-gray-500">
                                DOB: {{ $patient->date_of_birth }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="self-center">
                    <a
                        href="{{ route('patient.edit', $patient->id) }}"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                    >
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-gray-900 bg-white rounded-md wrapper">
        <header class="px-16 py-6">
            <h3 class="text-xl font-bold">{{ __("Patient Information") }}</h3>
        </header>
        <div class="px-16">
            <div class="py-6 border-t">
                <dl>
                    <x-description-list
                        :striped="true"
                        label="Full Name"
                        >{{ $patient->getFullName() }}</x-description-list
                    >
                    <x-description-list
                        label="Address"
                        >{{ $patient->getAddress() }}</x-description-list
                    >

                    <x-description-list
                        :striped="true"
                        label="Email"
                        >{{ $patient->email }}</x-description-list
                    >
                    <x-description-list
                        label="Phone"
                        >{{ $patient->phone }}</x-description-list
                    >

                    <x-description-list
                        :striped="true"
                        label="DPI Number"
                        >{{ $patient->dpi_number }}</x-description-list
                    >
                    <x-description-list
                        label="Identity"
                        >{{ $patient->identity }}</x-description-list
                    >

                    <x-description-list
                        :striped="true"
                        label="Primary Language"
                        >{{ $patient->primary_language }}</x-description-list
                    >
                    <x-description-list label="Parent/Guardian">
                        <button type="button" class="btn-secondary">
                            Add Parent
                        </button>
                    </x-description-list>
                </dl>
            </div>
        </div>

        <header class="px-16 py-6">
            <h3 class="text-xl font-bold">{{ __("Medical History") }}</h3>
        </header>
        <div class="px-16">
            <div class="py-6 border-t">
                <dl>
                    <div 
                    x-data="{ isOpen: false }"
                    x-on:click.away="isOpen = false">
                    <x-description-list
                        :striped="true"
                    >
                    <x-slot name="label">
                        <div class="flex">
                            <p>{{ __('Medical Problems') }}</p>
                            <div class="ml-2">
                                <button x-on:click="isOpen = !isOpen" type="button" class="btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </x-slot>
                    <div>
                        @foreach($patient->medicalProblems as $item)
                        <button wire:click="promptDeleteMedicalProblem(`{{ $item->id }}`)" 
                                type="button" class="flex justify-between w-full p-1 text-left border border-transparent hover:bg-red-100">
                                {{ $item->name }}
                                <x-heroicon-s-x class="w-5 h-5 text-red-700"/>
                        </button>
                        @endforeach
                        <form x-show="isOpen" wire:submit.prevent="addMedicalProblem" class="mt-2">
                            <div class="relative flex items-center gap-1">
                                <x-form.input-text wire:model.defer="medical_problem">
                                </x-form.input-text>
                                <button type="submit" class="btn-secondary">Add</button>
                            </div>
                        </form>
                    </div>
                    </x-description-list>
                </div>
                    
                    <x-description-list
                        label="{{ __('Current Medications') }}"
                    ></x-description-list>

                    <x-description-list
                        :striped="true"
                        label="{{ __('Allergies') }}"
                    ></x-description-list>
                    <x-description-list
                        label="{{ __('Prenatal History') }}"
                    ></x-description-list>

                    <x-description-list
                        :striped="true"
                        label="{{ __('Birth History') }}"
                    ></x-description-list>
                </dl>
            </div>
        </div>
    </div>
    <div class="mt-8 wrapper">
        @livewire('patient.patient-clinical-encounter')
    </div>
</div>

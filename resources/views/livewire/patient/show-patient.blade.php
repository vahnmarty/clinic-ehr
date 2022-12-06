<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<x-slot name="rightHeader"> </x-slot>

<div class="py-12 space-y-8">

    <!-- Modals -->
    <x-modal ref="create-parent" size="lg">
        <x-slot name="title">{{ __('Add Parent/Guardian') }}</x-slot>
        <div class="py-6">
            @livewire('patient.create-parent', ['patientId' => $patient_id])
        </div>
    </x-modal>
    <x-modal ref="prenatal-history" size="lg">
        <x-slot name="title">{{ __('Prenatal History') }}</x-slot>
        <div class="py-6">
            @livewire('patient.show-prenatal-history', ['patientId' => $patient_id])
        </div>
    </x-modal>
    <!-- End of Modals -->

    <div class="wrapper">
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
                                Patient ID: {{ $patient->patient_id }}
                            </p>
                            <p class="text-sm font-medium text-gray-500">
                                DOB: {{ $patient->date_of_birth }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="self-center">
                    <div x-data="{ isOpen: false }" class="inline-flex rounded-md shadow-sm">
                        <button type="button"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">Edit</button>
                        <div class="relative block -ml-px">
                            <button x-on:click="isOpen = !isOpen" type="button"
                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                                id="option-menu-button" aria-expanded="true" aria-haspopup="true">
                                <span class="sr-only">Open options</span>
                                <!-- Heroicon name: mini/chevron-down -->
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="isOpen" x-on:click.away="isOpen = false" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 w-56 mt-2 -mr-1 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="option-menu-button"
                                tabindex="-1">
                                <div class="py-1" role="none">
                                    <a href="{{ route('patient.edit', $patient->id) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                        tabindex="-1">
                                        Edit Patient (Birth; Demographics)
                                    </a>

                                    <a href="#" x-on:click.prevent="$dispatch('openmodal-prenatal-history'); isOpen = false" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">
                                        Edit Prenatal History
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

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
                    <x-description-list label="Phone">{{ $patient->phone }}</x-description-list>

                    <x-description-list :striped="true" label="DPI Number">{{ $patient->dpi_number }}
                    </x-description-list>
                    <x-description-list label="Identity">{{ $patient->identity }}</x-description-list>

                    <x-description-list :striped="true" label="Primary Language">{{ $patient->primary_language }}
                    </x-description-list>
                    <x-description-cta>
                        <x-slot name="label">
                            <div class="flex justify-between pr-8">
                                Parent/Guardian
                                <button x-data x-on:click="$dispatch('openmodal-create-parent');" type="button" class="ml-1 btn-icon">
                                    <x-heroicon-s-plus class="w-3 h-3" />
                                </button>
                            </div>
                        </x-slot>
                        <div>
                            @foreach ($patient->guardians as $guardian)
                            <div wire:key="guardian-{{ $guardian->id .'-'. time() }}" class="font-medium">
                                <a href="{{ route('patient.edit-parent', ['id' => $patient->id, 'parentId' => $guardian->id]) }}"
                                    class="flex justify-between w-full p-1 text-left border border-dashed hover:bg-green-100">
                                    <p>
                                        <strong>({{ $guardian->parent_type->description }})</strong>
                                        {{ $guardian->first_name . ' ' .$guardian->last_name }}
                                    </p>
                                    <x-heroicon-s-eye class="w-5 h-5 text-green-700" />
                                </a>
                                
                            </div>
                            @endforeach

                            
                            
                        </div>
                    </x-description-cta>
                </dl>
            </div>
        </div>

        <header class="px-16 py-6">
            <h3 class="text-xl font-bold">{{ __('Medical History') }}</h3>
        </header>
        <div class="px-16">
            <div class="py-6 border-t">
                <dl>
                    <div x-data="{ isOpen: false, edit: false }" 
                        x-on:click.away="isOpen = false">
                        <x-description-list :striped="true">
                            <x-slot name="label">
                                <div class="flex justify-between pr-8">
                                    <p>{{ __('Medical Problems') }}</p>
                                    <div class="ml-2">
                                        <button x-on:click="isOpen = !isOpen" type="button" class="btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </x-slot>
                            <div>
                                @foreach ($patient->medicalProblems as $item)
                                <div x-data="{ edit: false, medical_problem: `{{ $item->name }}` }"
                                    x-on:close-edit.window="edit = false"
                                    x-on:click.away="edit = false"
                                    wire:key="mp-{{ $item['id'] . '-' . time() }}">
                                    <button 
                                        x-on:click="edit = true;"
                                        x-show="!edit"
                                        type="button"
                                        class="flex justify-between w-full p-1 text-left border border-transparent hover:bg-green-100">
                                        {{ $item->name }}
                                        <x-heroicon-s-pencil class="w-5 h-5 text-yellow-700" />
                                    </button>
                                    <form x-show="edit" class="mt-2">
                                        <div class="relative flex items-center gap-1">
                                            <x-form.input-text x-model="medical_problem" required/>
                                            <button x-on:click="$wire.updateMedicalProblem(`{{ $item->id }}`, medical_problem)" type="button" class="btn-secondary">Update</button>
                                            <button wire:click="promptDeleteMedicalProblem(`{{ $item['id'] }}`)" type="button" class="btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                                <form x-show="isOpen" wire:submit.prevent="addMedicalProblem" class="mt-2">
                                    <div class="relative flex items-center gap-1">
                                        <x-form.input-text wire:model.defer="medical_problem" required>
                                        </x-form.input-text>
                                        <button type="submit" class="btn-secondary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </x-description-list>
                    </div>

                    <div x-data="{ isOpen: false }" x-on:click.away="isOpen = false">
                        <x-description-list :striped="false">
                            <x-slot name="label">
                                <div class="flex justify-between pr-8">
                                    <p>{{ __('Current Medications') }}</p>
                                    <div class="ml-2">
                                        <button x-on:click="isOpen = !isOpen" type="button" class="btn-icon">
                                            <x-heroicon-s-plus class="w-3 h-3" />
                                        </button>
                                    </div>
                                </div>
                            </x-slot>
                            <div>
                                @foreach ($patient->medications as $item)
                                <div x-data="{ edit: false, medication: `{{ $item->name }}` }"
                                    x-on:close-edit.window="edit = false"
                                    x-on:click.away="edit = false"
                                    wire:key="medic-{{ $item['id'] . '-' . time() }}">
                                    <button 
                                        x-on:click="edit = true;"
                                        x-show="!edit"
                                        type="button"
                                        class="flex justify-between w-full p-1 text-left border border-transparent hover:bg-green-100">
                                        {{ $item->name }}
                                        <x-heroicon-s-pencil class="w-5 h-5 text-yellow-700" />
                                    </button>
                                    <form x-show="edit" class="mt-2">
                                        <div class="relative flex items-center gap-1">
                                            <x-form.input-text x-model="medication" required/>
                                            <button x-on:click="$wire.updateMedication(`{{ $item->id }}`, medication)" type="button" class="btn-secondary">Update</button>
                                            <button wire:click="promptDeleteMedication(`{{ $item['id'] }}`)" type="button" class="btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach

                                <form x-show="isOpen" wire:submit.prevent="addMedication" class="mt-2">
                                    <div class="relative flex items-center gap-1">
                                        <x-form.input-text wire:model.defer="medication" required>
                                        </x-form.input-text>
                                        <button type="submit" class="btn-secondary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </x-description-list>
                    </div>


                    <div x-data="{ isOpen: false }" x-on:click.away="isOpen = false">
                        <x-description-list :striped="true">
                            <x-slot name="label">
                                <div class="flex justify-between pr-8">
                                    <p>{{ __('Allergies') }}</p>
                                    <div class="ml-2">
                                        <button x-on:click="isOpen = !isOpen" type="button" class="btn-icon">
                                            <x-heroicon-s-plus class="w-3 h-3" />
                                        </button>
                                    </div>
                                </div>
                            </x-slot>
                            <div>
                                @foreach ($patient->allergies as $item)
                                <div x-data="{ edit: false, allergy: `{{ $item->name }}` }"
                                    x-on:close-edit.window="edit = false"
                                    x-on:click.away="edit = false"
                                    wire:key="allerg-{{ $item['id'] . '-' . time() }}">
                                    <button 
                                        x-on:click="edit = true;"
                                        x-show="!edit"
                                        type="button"
                                        class="flex justify-between w-full p-1 text-left border border-transparent hover:bg-green-100">
                                        {{ $item->name }}
                                        <x-heroicon-s-pencil class="w-5 h-5 text-yellow-700" />
                                    </button>
                                    <form x-show="edit" class="mt-2">
                                        <div class="relative flex items-center gap-1">
                                            <x-form.input-text x-model="allergy" required/>
                                            <button x-on:click="$wire.updateAllergy(`{{ $item->id }}`, allergy)" type="button" class="btn-secondary">Update</button>
                                            <button wire:click="promptDeleteAllergy(`{{ $item['id'] }}`)" type="button" class="btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach

                                <form x-show="isOpen" wire:submit.prevent="addAllergy" class="mt-2">
                                    <div class="relative flex items-center gap-1">
                                        <x-form.input-text wire:model.defer="allergy" required>
                                        </x-form.input-text>
                                        <button type="submit" class="btn-secondary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </x-description-list>
                    </div>

                    <div x-data>
                        <x-description-list :striped="false">
                            <x-slot name="label">
                                <div class="flex justify-between pr-8">
                                    <p>{{ __('Prenatal History') }}</p>
                                    <div class="ml-2">
                                        <button x-on:click="$dispatch('openmodal-prenatal-history')" type="button" class="btn-icon">
                                            <x-heroicon-s-pencil class="w-3 h-3" />
                                        </button>
                                    </div>
                                </div>
                            </x-slot>
                            <div>
                                <div class="p-1 hover:bg-green-100">
                                    {{ $patient->prenatal->pregnancy_number ?? '' }}
                                </div>
                            </div>
                        </x-description-list>
                    </div>

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

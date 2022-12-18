<div>
    
    <x-modal ref="create" size="lg">
        <x-slot name="title">{{ __('Create Patient') }}</x-slot>
        <div class="py-6">
            @livewire('patient.create-patient')
        </div>
    </x-modal>

    <x-modal ref="checkin" size="md">
        <x-slot name="title">{{ __('Check-in Patient') }}</x-slot>
        <div class="py-6">
            @livewire('patient.check-in-patient')
        </div>
    </x-modal>
    
    <header class="flex justify-between">
        <h3 class="text-2xl font-bold">{{ __('Patient List') }}</h3>
        <div x-data>
            <a href="{{ route('dashboard') }}" x-on:click.prevent="$dispatch('openmodal-create')" class="btn-primary">{{ __('Add New Patient') }}</a>
        </div>
    </header>
    <div class="mt-8 ">
        <div>
           <x-table.table-wrapper>
            <thead class="bg-gray-50">
                <tr>
                    <x-table.th class="text-center">{{ __('Picture') }}</x-table.th>
                    <x-table.th>{{ __('ID') }}</x-table.th>
                    <x-table.th>{{ __('First Name') }}</x-table.th>
                    <x-table.th>{{ __('Last Name') }}</x-table.th>
                    <x-table.th>{{ __('Date of Birth') }}</x-table.th>
                    <x-table.th>{{ __('Condition') }}</x-table.th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($patients as $patient)
                    <tr>
                        <x-table.td class="flex justify-center">
                            <img src="{{ $patient->getAvatar() }}" class="w-6 h-6 rounded-full"
                                alt="">
                        </x-table.td>
                        <x-table.td>
                            <p>#{{ $patient->patient_id }}</p>
                        </x-table.td>
                        <x-table.td>
                            <p>{{ $patient->first_name }}</p>
                        </x-table.td>
                        <x-table.td>
                            <p>{{ $patient->last_name }}</p>
                        </x-table.td>
                        <x-table.td>
                            <p>{{ $patient->date_of_birth }}</p>
                        </x-table.td>
                        <x-table.td>
                            
                        </x-table.td>
                        <x-table.td class="flex justify-end pr-8">
                            <div class="flex gap-4">
                                <a href="{{ route('patient.show', $patient->id) }}">
                                    <x-heroicon-s-user class="w-4 h-4 text-gray-500 hover:text-red-700"/>
                                </a>
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <x-heroicon-s-pencil class="w-4 h-4 text-gray-500 cursor-pointer hover:text-green-700"/>
                                    </x-slot>
                
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('patient.edit', $patient->id)">
                                                {{ __('Edit Patient Chart') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link href="#" 
                                            wire:click.prevent="checkInPatient(`{{ $patient->id }}`)">
                                                {{ __('Check In Patient') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>

                                <a href="#" wire:click="deletePatient(`{{ $patient->id }}`)">
                                    <x-heroicon-s-trash class="w-4 h-4 text-gray-500 hover:text-red-700"/>
                                </a>
                            </div>
                        </x-table.td>
                    </tr>
                @endforeach
            </tbody>
           </x-table.table-wrapper>

           <div class="mt-8">
            {{ $patients->links() }}
           </div>
           
        </div>
    </div>
</div>
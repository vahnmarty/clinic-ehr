<div>
    
    <x-modal ref="create" size="lg">
        <x-slot name="title">{{ __('Create Patient') }}</x-slot>
        <div class="py-6">
            @livewire('patient.create-patient')
        </div>
    </x-modal>
    
    <header class="flex justify-between">
        <h3 class="text-2xl font-bold">{{ __('Clinic Dashboard') }}</h3>
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
                    <x-table.th>{{ __('Visit Reason') }}</x-table.th>
                    <x-table.th>{{ __('Arrival Time') }}</x-table.th>
                    <x-table.th>{{ __('Doctor') }}</x-table.th>
                    <x-table.th>{{ __('Status') }}</x-table.th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($patients as $checkin)
                    <tr>
                        <x-table.td class="flex justify-center">
                            <img src="{{ $checkin->patient->image_avatar ?? '' }}" class="w-6 h-6 rounded-full"
                                alt="">
                        </x-table.td>
                        <x-table.td>
                            <p>#{{ $checkin->patient->patient_id }}</p>
                        </x-table.td>
                        <x-table.td>
                            <p>{{ $checkin->patient->first_name }}</p>
                        </x-table.td>
                        <x-table.td>
                            <p>{{ $checkin->visit_reason }}</p>
                        </x-table.td>

                        <x-table.td>
                            
                        </x-table.td>
                        <x-table.td>
                            <p>{{ $checkin->doctor->name }}</p>
                        </x-table.td>
                        <x-table.td>
                            
                        </x-table.td>
                        <x-table.td class="flex justify-end pr-8">
                            <div class="flex gap-4">
                                <a href="">
                                    <x-heroicon-s-pencil class="w-4 h-4 text-gray-500 hover:text-green-700"/>
                                </a>
                                <a href="">
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
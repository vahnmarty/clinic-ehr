<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Station 4: {{ __('Research Forms') }}
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
                    {{ $this->table }}
                </div>
            @endif
        @endif
    </div>
</div>

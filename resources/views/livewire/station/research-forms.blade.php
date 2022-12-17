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
            @if ($patient_id)
            @includeIf('livewire.station._patient', ['patient' => $patient])
            @endif
                <div class="mt-8">
                    {{ $this->table }}
                </div>
            @endif
        @endif
    </div>
</div>

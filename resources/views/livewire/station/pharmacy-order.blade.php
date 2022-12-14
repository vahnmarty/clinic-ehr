<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Station 6: {{ __('Pharmacy Order') }}
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
        @includeIf('livewire.station._patient', ['patient' => $patient])
        @endif

        <h1 class="text-2xl font-bold">Patient Orders</h1>

        <div class="mt-8">
            {{ $this->table }}
        </div>
    </div>
</div>

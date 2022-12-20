<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Station 2: {{ __('Update Patient Information') }}
    </h2>
    <x-slot name="rightHeader">
        <div x-data class="flex justify-end">
            <button type="button" class="btn-secondary" x-on:click="$dispatch('openmodal-search')">Search Patient</button>
        </div>
    </x-slot>
</x-slot>

<div class="py-12" x-data>
    <div class="wrapper">

        @if ($patient_id)
            @if ($patient)
                @include('livewire.station._patient', ['patient' => $patient])

                @if ($step == 'basic')
                    <form wire:submit.prevent="save" class="mt-8">
                        {{ $this->form }}

                        <div class="flex justify-end gap-4 mt-8">
                            <button type="submit" class="btn-secondary">{{ __('Save Changes and Proceed') }}</button>
                            <button type="button" wire:click="next('parents')"
                                class="btn-light">{{ __('Skip') }}</button>
                        </div>
                    </form>
                @endif

                @if ($step == 'parents')
                    @livewire('station.patient-parent', ['patientId' => $patient_id])

                    <div class="flex justify-end gap-4 mt-8">
                        <button type="button" wire:click="saveParents()"
                            class="btn-secondary">{{ __('Save Changes and Proceed') }}</button>
                        <button type="button" wire:click="next('medical')"
                            class="btn-light">{{ __('Skip') }}</button>
                    </div>
                @endif

                @if ($step == 'medical')
                    @livewire('station.patient-medical-history', ['patientId' => $patient_id])
                    @livewire('station.patient-current-medications', ['patientId' => $patient_id])

                    <div class="flex justify-end gap-4 mt-8">
                        <button type="button" wire:click="promptMedicalHistory()"
                            class="btn-secondary">{{ __('Save Changes and Proceed') }}</button>
                    </div>
                @endif
            @endif
        @endif
    </div>
</div>

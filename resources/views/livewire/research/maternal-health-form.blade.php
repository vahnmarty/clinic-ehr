<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Intermittent Health Form') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="mt-8 space-y-8 wrapper">

        @include('livewire.station._patient', ['patient' => $patient])
        <form wire:submit.prevent="save">
            {{ $this->form }}

            <button type="submit" class="mt-8 btn-secondary">{{ $is_edit ? 'Update' : 'Save'}}</button>
            @if($is_edit)
            <a href="{{ url('station/research', $patient_id) }}" class="btn-light">Back</a>
            @endif
        </form>
    </div>
</div>

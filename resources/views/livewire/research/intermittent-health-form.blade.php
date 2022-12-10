<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Intermittent Health Form') }}
    </h2>
</x-slot>

<div class="py-6">
    @if ($patient)
        <div class="wrapper">
            <div class="py-6">
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
            </div>
        </div>
    @endif
    <div class="mt-8 wrapper">
        <form wire:submit.prevent="save">
            {{ $this->form }}

            <button type="submit" class="mt-8 btn-secondary">{{ $is_edit ? 'Update' : 'Save'}}</button>
            @if($is_edit)
            <a href="{{ url('station/research', $patient_id) }}" class="btn-light">Back</a>
            @endif
        </form>
    </div>
</div>

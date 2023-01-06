<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Station 1: {{ __('Check Patient') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="wrapper">

        <x-form.form-group>
            <x-slot name="label">
                {{ __('Select') }}
                <x-required />
            </x-slot>
            <div class="flex gap-4">
                <label class="flex items-center gap-4">
                    <input type="radio" wire:model="type" value="new">
                    <span>New Patient</span>
                </label>
                <label class="flex items-center gap-4">
                    <input type="radio" wire:model="type" value="old">
                    <span>Existing Patient</span>
                </label>
            </div>
        </x-form.form-group>

        @if ($type == 'new')
            @livewire('patient.create-patient')
        @endif

        @if ($type == 'old')
            <div class="py-6">

                @if ($patient)
                    @include('livewire.station._patient', ['patient' => $patient])
                    
                    <form wire:submit.prevent="save" class="mt-8">
                        {{ $this->form }}

                        <div class="flex justify-end mt-8">
                            <button type="submit" class="btn-secondary">{{ __('Check In') }}</button>
                        </div>
                    </form>
                @else
                    <div>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <x-heroicon-s-search class="w-6 h-6 text-gray-400" />
                            </div>
                            <input type="search" wire:model="search"
                                class="block w-full py-4 pl-10 text-lg border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Search Name or Patient ID">
                        </div>
                    </div>

                    <div class="mt-8 max-h-[28rem] min-h-[24rem] overflow-auto">
                        <div class="space-y-1">
                            @foreach ($results as $index => $result)
                                <div wire:click="setPatient(`{{ $result->id }}`)"
                                    wire:key="sr-{{ $index . '-' . time() }}"
                                    class="p-4 py-4 duration-300 ease-in-out border cursor-pointer hover:bg-blue-100 hover:shadow-lg">
                                    <div class="flex">
                                        <div class="w-16 h-16 overflow-hidden border-2 rounded-full shadow-lg">
                                            <img src="{{ $result['image_avatar'] }}" alt=""
                                                class="w-16 h-16" />
                                        </div>
                                        <div class="pl-4">
                                            <h3 class="font-bold">{{ $result['patient_id'] }}</h3>
                                            <h2>{{ $result['full_name'] }}</h2>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        @endif

    </div>
</div>

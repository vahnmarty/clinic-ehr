<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $clinic->name }} | 
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="rightHeader">
        <div class="grid grid-cols-2 gap-4">
            <form id="form-clinic" x-data="{ clinic_id: {{ $clinic->id }} }">
                <x-form.select name="clinic_id" onchange="document.querySelector('#form-clinic').submit()">
                    <option value="">-- {{ __('All Clinic ') }} --</option>
                    @foreach($clinics as $clinicItem)
                    <option value="{{ $clinicItem->id }}" :selected="clinic_id == {{ $clinicItem->id }}">{{ $clinicItem->name }}</option>
                    @endforeach
                </x-form.select>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <section></section>

            <div class="py-6">
                @livewire('patient.clinic-patients', ['clinic_id' => $clinic->id])
            </div>
        </div>
    </div>
</x-app-layout>

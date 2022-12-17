<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('View Clinical Encounter') }}
    </h2>

    <x-slot name="rightHeader">
        <div x-data class="flex justify-end">
            <a href="{{ route('patient.show', $patient->id) }}" class="btn-light">Back</a>
        </div>
    </x-slot>

</x-slot>

<div class="py-12">
    <div class="wrapper">
        <div class="grid grid-cols-5 gap-4">
            <div class="col-span-3 space-y-4">
                <x-form.form-group>
                    <x-slot name="label">
                        {{ __('Chief Complaint') }}
                    </x-slot>
                    <x-form.input-text value="{{ $encounter->chief_complaint }}" placeholder="Chief Complaint" class="bg-white" readonly/>
                    <x-input-error :messages="$errors->get('chief_complaint')" class="mt-2" />
                </x-form.form-group>
                <x-form.form-group>
                    <x-slot name="label">
                        {{ __('History of Illness') }} 
                    </x-slot>
                    <div class="p-4 mt-2 bg-white border border-gray-300 rounded-md">{{ $encounter->illness_history }}</div>
                    <x-input-error :messages="$errors->get('chief_complaint')" class="mt-2" />
                </x-form.form-group>
                <x-form.form-group>
                    <x-slot name="label">
                        {{ __('Physical Exam') }}
                    </x-slot>
                    <div class="p-4 mt-2 bg-white border border-gray-300 rounded-md">{{ $encounter->physical_exam }}</div>
                    <x-input-error :messages="$errors->get('chief_complaint')" class="mt-2" />
                </x-form.form-group>
                <x-form.form-group>
                    <x-slot name="label">
                        {{ __('Encounter Impression') }}
                    </x-slot>
                    <div class="p-4 mt-2 bg-white border border-gray-300 rounded-md">{{ $encounter->impression }}</div>
                    <x-input-error :messages="$errors->get('chief_complaint')" class="mt-2" />
                </x-form.form-group>
            </div>
        </div>
    </div>
</div>

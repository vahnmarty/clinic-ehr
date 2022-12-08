<form method="POST" wire:submit.prevent="save">
    <section class="grid grid-cols-2 gap-6 mt-8">
        <x-form.form-group>
            <x-slot name="label">
                {{ __('Select Clinic') }} <x-required/>
            </x-slot>
            <x-form.select wire:model.defer="clinic_id" required>
                <option value="">-- Select Clinic --</option>
                @foreach($clinics as $clinic)
                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                @endforeach
            </x-form.select>
            <x-input-error :messages="$errors->get('clinic_id')" class="mt-2" />
        </x-form.form-group>
        @if($patient)
        <x-form.form-group>
            <x-slot name="label">
                {{ __('Patient') }} <x-required/>
            </x-slot>
            <x-form.input-text disabled value="{{ $patient->getFullName() }}" placeholder="Full Name"/>
            <x-input-error :messages="$errors->get('patient_id')" class="mt-2" />
        </x-form.form-group>
        @endif
        <x-form.form-group>
            <x-slot name="label">
                {{ __('Visit Reason') }} <x-required/>
            </x-slot>
            <x-form.input-text wire:model.defer="visit_reason" required placeholder="Write reason"/>
            <x-input-error :messages="$errors->get('visit_reason')" class="mt-2" />
        </x-form.form-group>
        <x-form.form-group>
            <x-slot name="label">
                {{ __('Assign Doctor') }} <x-required/>
            </x-slot>
            <x-form.select wire:model.defer="doctor_id" required>
                <option value="">-- Select Doctor --</option>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </x-form.select>
            <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
        </x-form.form-group>
    </section>

    <div class="flex justify-end mt-8">
        <button type="submit" class="btn-secondary">{{ __("Check In") }}</button>
    </div>
</form>
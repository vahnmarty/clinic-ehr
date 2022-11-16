<form method="POST" wire:submit.prevent="store">
    <section>
        <label for="">
            <input type="file" accept="image" class="hidden">

            <div class="flex items-center">
                <x-heroicon-m-user-circle class="w-32 h-32 text-gray-600"/>

                <button type="button" class="ml-5 btn-secondary">{{ __("Add Photo") }}</button>
            </div>
        </label>
    </section>

    <section class="grid grid-cols-3 gap-6 mt-8">
        <x-form.form-group>
            <x-slot name="label">
                {{ __('First Name') }} <x-required/>
            </x-slot>
            <x-form.input-text wire:model.defer="first_name" required/>
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </x-form.form-group>
        <x-form.form-group>
            <x-slot name="label">
                {{ __('Last Name') }} <x-required/>
            </x-slot>
            <x-form.input-text wire:model.defer="last_name" required/>
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </x-form.form-group>
        <x-form.form-group>
            <x-slot name="label">
                {{ __('Email') }}
            </x-slot>
            <x-form.input-text type="email" wire:model.defer="email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </x-form.form-group>
        <x-form.form-group>
            <x-slot name="label">
                {{ __('Date of Birth') }}
            </x-slot>
            <x-form.input-text type="date" wire:model.defer="date_of_birth"/>
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </x-form.form-group>
    </section>

    <div class="mt-8">
        <button type="submit" class="btn-secondary">{{ __('Add Patient') }}</button>
    </div>
</form>
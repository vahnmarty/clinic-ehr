<form method="POST" wire:submit.prevent="store">
    <section>
        <label for="avatar">

            <div class="flex items-center">
                @if($avatar)
                <div class="p-4 bg-gray-100 rounded-full shadow-sm w-32-h-32">
                    <img src="{{ $avatar->temporaryUrl() }}" class="object-cover w-28 h-28">
                </div>
                @else
                <x-heroicon-m-user-circle class="w-32 h-32 text-gray-600"/>
                @endif

                <input id="avatar" wire:model="avatar" type="file" accept="image/png, image/gif, image/jpeg"  class="">
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
        <x-form.form-group>
            <x-slot name="label">
                {{ __('Sex') }}
            </x-slot>
            <x-form.select wire:model="sex">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </x-form.select>
            <x-input-error :messages="$errors->get('sex')" class="mt-2" />
        </x-form.form-group>
    </section>

    <div class="mt-8">
        <button type="submit" class="btn-secondary">{{ __('Add Patient') }}</button>
    </div>
</form>
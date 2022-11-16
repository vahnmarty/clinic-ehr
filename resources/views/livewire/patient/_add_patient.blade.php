<x-modal ref="create" size="lg">
    <x-slot name="title">{{ __('Create Patient') }}</x-slot>
    <div class="py-6">
        <form action="">

            <section>
                <label for="">
                    <input type="file" accept="image" class="hidden">

                    <div class="flex items-center">
                        <x-heroicon-m-user-circle class="w-32 h-32 text-gray-600"/>

                        <button type="button" class="ml-5 btn-secondary">{{ __("Add Photo") }}</button>
                    </div>
                </label>
            </section>

            <section class="grid grid-cols-3 gap-6">
                
            </section>
        </form>
    </div>
</x-modal>
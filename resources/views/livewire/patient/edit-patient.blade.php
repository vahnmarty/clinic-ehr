<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __("Edit Patient") }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="wrapper">
        <form wire:submit.prevent="submit">
            {{ $this->form }}

            <div class="mt-8">
                <button
                    type="button"
                    wire:click="submit"
                    class="btn-secondary btn-lg"
                >
                    {{ __("Update") }}
                </button>
            </div>
        </form>
    </div>
</div>

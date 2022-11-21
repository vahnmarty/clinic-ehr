<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __("Edit Patient") }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="wrapper">
        <div class="flex">
            <a
                href="{{ route('patient.show', $patient->id) }}"
                class="btn-light"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 mr-2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5"
                    />
                </svg>

                Back</a
            >
        </div>

        <form wire:submit.prevent="submit" class="mt-8">
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

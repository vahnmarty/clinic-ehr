<div class="py-6">
    <header class="mb-8">
        <h2 class="text-xl font-bold">Prenatal History</h2>
    </header>

    <form wire:submit.prevent="save" class="p-4 mt-8 bg-white border rounded-md shadow-sm">
        {{ $this->form }}

        <div class="mt-8">
            <button
                type="submit"
                class="btn-secondary"
            >
                {{ __("Update Prenatal History") }}
            </button>
        </div>
    </form>
</div>

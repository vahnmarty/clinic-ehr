<form wire:submit.prevent="save" class="mt-8">
    {{ $this->form }}

    <div class="mt-8">
        <button
            type="submit"
            class="btn-secondary btn-lg"
        >
            {{ __("Save") }}
        </button>
    </div>
</form>
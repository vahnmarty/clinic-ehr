<form method="POST" wire:submit.prevent="store">
    {{ $this->form }}

    <div class="mt-8">
        <button type="submit" class="btn-secondary">{{ __('Save') }}</button>
    </div>
</form>
<form method="POST" wire:submit.prevent="update">
    {{ $this->form }}

    <div class="mt-8">
        <button type="submit" class="btn-secondary">{{ __('Update') }}</button>
    </div>
</form>
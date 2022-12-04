<div>

    <div class="flex mb-8">
        <button type="button" wire:click="promptDelete" class="btn-danger">{{ __('Delete') }}</button>
    </div>
    
    <form method="POST" wire:submit.prevent="update">
        {{ $this->form }}
    
        <div class="mt-8">
            <button type="submit" class="btn-secondary">{{ __('Update') }}</button>
        </div>
    </form>
</div>
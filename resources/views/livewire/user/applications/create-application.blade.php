<div  class="py-6">
    <form wire:submit.prevent="submit">
        {{ $this->form }}
     
        <button type="submit" class="mt-4 btn-primary">
            Submit
        </button>
    </form>
</div>
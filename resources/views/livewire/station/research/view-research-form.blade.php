<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Station 4: {{ __('Research Forms') }}
    </h2>
    <x-slot name="rightHeader">
        <div class="flex gap-2 jusitfy-end">
            
            <a href="#" class="btn-light">Edit</a>
            <a href="#" class="btn-light">Back</a>
        </div>
    </x-slot>
</x-slot>

<div class="py-12">
    <div class="wrapper">
        <button wire:click="download" type="button" class="btn-light">Download</button>
        {{ $this->form }}
    </div>
</div>

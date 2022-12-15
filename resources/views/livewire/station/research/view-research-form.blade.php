<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
         {{  Str::title($form_type) }}
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
        <div class="mt-8">
            {{ $this->form }}
        </div>
    </div>
</div>

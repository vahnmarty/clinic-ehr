<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Vaccines') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class=" wrapper">

        <div>
            {{ $this->table }}
        </div>
    </div>
</div>

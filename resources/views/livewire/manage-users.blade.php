<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Users') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="space-y-8 wrapper">

        <div class="mt-8">
            {{ $this->table }}
        </div>
    </div>
</div>

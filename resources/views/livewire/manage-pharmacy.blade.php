<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Pharmacy Orders
    </h2>
</x-slot>

<div class="py-12">
    <div class="space-y-8 wrapper">

        <div>
            {{ $this->table }}
        </div>
    </div>
</div>

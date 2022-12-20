@props(['label'])
<div
    class="items-start py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
>
    <dt class="text-sm font-bold text-gray-900">
        {{ $label }}
    </dt>
    <dd class="mt-1 text-sm text-gray-600 underline sm:col-span-3 lg:col-span-2 sm:mt-0">
        {{ $slot }}
    </dd>
</div>

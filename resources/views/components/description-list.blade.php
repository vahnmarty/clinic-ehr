@props(['label', 'striped' => false])
<div
    class="py-3 {{
        $striped ? 'bg-indigo-50' : 'bg-white'
    }} sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3 items-start"
>
    <dt class="text-sm font-bold text-gray-900">
        {{ $label }}
    </dt>
    <dd class="mt-1 text-sm text-gray-600 underline sm:col-span-3 lg:col-span-2 sm:mt-0">
        {{ $slot }}
    </dd>
</div>

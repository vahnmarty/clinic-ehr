@props(['striped' => false])
<div
    class="px-4 py-5 {{
        $striped ? 'bg-indigo-50' : 'bg-white'
    }} sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-start"
>
    <dt class="text-sm font-medium text-gray-700">
        {{ $label }}
    </dt>
    <dd class="mt-1 text-sm font-bold text-gray-900 sm:col-span-2 sm:mt-0">
        {{ $slot }}
    </dd>
</div>

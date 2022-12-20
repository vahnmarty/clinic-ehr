<div
    {{ $attributes->merge(['class' => 'relative px-4 pt-5 pb-5 overflow-hidden rounded-lg shadow sm:px-6 sm:pt-6 border']) }}>
    <dt>
        <div class="absolute p-3 bg-gray-900 rounded-full">
            {{ $icon }}
        </div>
        <p class="ml-16 text-sm font-bold text-gray-900">{{ $label }}</p>
    </dt>
    <dd class="flex items-baseline ml-16 text-lg">
        {{ $slot }}
    </dd>
</div>

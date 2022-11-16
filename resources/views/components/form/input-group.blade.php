@props(['disabled' => false])

<div class="relative">
    {{ $slot }}
    <div class="absolute px-2 bg-gray-200 rounded-md right-3 top-2">
        {{ $rightAddon ?? '' }}
    </div>
</div>

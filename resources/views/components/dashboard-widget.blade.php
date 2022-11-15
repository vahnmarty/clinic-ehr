<div class="relative px-4 pt-5 pb-5 overflow-hidden bg-white rounded-lg shadow sm:px-6 sm:pt-6">
    <dt>
      <div class="absolute p-3 bg-gray-900 rounded-md">
        {{ $icon }}
      </div>
      <p class="ml-16 text-sm font-medium text-gray-500 truncate">{{ $label }}</p>
    </dt>
    <dd class="flex items-baseline ml-16">
      {{ $slot }}
    </dd>
  </div>
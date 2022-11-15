<div x-data="{ 
        isOpen: false,
        size: '{{ $size }}'
     }" 
    x-on:openmodal-{{ $ref }}.window="isOpen = true" 
    x-show="isOpen" 
    x-cloak 
    class="relative z-10"
    aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div x-show="isOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">

            <div x-show="isOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-on:click.away="isOpen = false"
                class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-sm sm:p-6"
                :class="{ 'sm:max-w-7xl': size == 'full', 'sm:max-w-4xl' : size == 'lg' }">

                <div class="flex justify-between">
                    <header>
                        <h1 class="text-lg font-bold">{{ $title }}</h1>
                    </header>
                    <button x-on:click="isOpen = false" type="button">
                        <x-heroicon-m-x-mark class="w-6 h-6 text-gray-600 hover:text-gray-900" />
                    </button>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>
</div>

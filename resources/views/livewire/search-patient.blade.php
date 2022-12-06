<x-modal ref="search" size="md">
    <x-slot name="title">{{ __('Search Patient') }}</x-slot>
    <div class="py-6">

        <div>
            <div class="relative mt-1 rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-s-search class="w-6 h-6 text-gray-400" />
                </div>
                <input type="search" wire:model="search"
                    class="block w-full py-4 pl-10 text-lg border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Search Name or Patient ID">
            </div>
        </div>

        <div class="mt-8 max-h-[28rem] min-h-[24rem] overflow-auto">
            <div class="space-y-1">
                @foreach ($results as $result)
                    <div
                        class="p-4 py-4 duration-300 ease-in-out border cursor-pointer hover:bg-blue-100 hover:shadow-lg">
                        <div class="flex">
                            <div class="w-16 h-16 overflow-hidden border-2 rounded-full shadow-lg">
                                <img src="{{ $result['image_avatar'] }}" alt="" class="w-16 h-16" />
                            </div>
                            <div class="pl-4">
                                <h3 class="font-bold">{{ $result['patient_id'] }}</h3>
                                <h2>{{ $result['full_name'] }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-modal>

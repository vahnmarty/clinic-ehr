<x-slot name="header">
    <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
</x-slot>

<div class="px-5 py-6 bg-white rounded-lg shadow sm:px-6 min-h-[16rem]">
    <div class="grid grid-cols-3 gap-8 ">
        @foreach($tenants as $tenant)
        <div class="border-2 rounded-md">
            <header class="flex px-4 py-4">
                <div>
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-200 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-gray-600">
                            <path d="M19.006 3.705a.75.75 0 00-.512-1.41L6 6.838V3a.75.75 0 00-.75-.75h-1.5A.75.75 0 003 3v4.93l-1.006.365a.75.75 0 00.512 1.41l16.5-6z" />
                            <path fill-rule="evenodd" d="M3.019 11.115L18 5.667V9.09l4.006 1.456a.75.75 0 11-.512 1.41l-.494-.18v8.475h.75a.75.75 0 010 1.5H2.25a.75.75 0 010-1.5H3v-9.129l.019-.006zM18 20.25v-9.565l1.5.545v9.02H18zm-9-6a.75.75 0 00-.75.75v4.5c0 .414.336.75.75.75h3a.75.75 0 00.75-.75V15a.75.75 0 00-.75-.75H9z" clip-rule="evenodd" />
                          </svg>
                    </div>
                </div>
                <div class="w-full pl-4">
                    <div class="flex justify-between">
                        <h2 class="font-bold">{{ $tenant->id }}</h2>
                        <span class="px-2 py-1 text-xs bg-green-300 rounded-lg">FREE</span>
                    </div>
                    <a href="{{ 'http://' . $tenant->domains()->first()?->domain }}" target="_blank" class="block text-xs text-purple-500">{{ 'http://' . $tenant->domains()->first()?->domain }}</a>
                </div>
            </header>
        </div>
        @endforeach
    </div>
</div>
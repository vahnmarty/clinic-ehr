<x-slot name="header">
    <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
</x-slot>

<div>
    <div class="grid grid-cols-3 gap-8">
        <div class="col-span-2">
            @if (Auth::user()->tenants()->count())
                <h2 class="mb-4 text-xl font-bold">My Applications</h2>
                <div class="grid grid-cols-2 gap-5">
                    @foreach ($tenants as $tenant)
                        <div class="bg-white rounded-md shadow-md cursor-pointer">
                            <header class="flex px-4 py-4">
                                <div>
                                    <div class="flex items-center justify-center rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-8 h-8 text-blue-500">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM6.262 6.072a8.25 8.25 0 1010.562-.766 4.5 4.5 0 01-1.318 1.357L14.25 7.5l.165.33a.809.809 0 01-1.086 1.085l-.604-.302a1.125 1.125 0 00-1.298.21l-.132.131c-.439.44-.439 1.152 0 1.591l.296.296c.256.257.622.374.98.314l1.17-.195c.323-.054.654.036.905.245l1.33 1.108c.32.267.46.694.358 1.1a8.7 8.7 0 01-2.288 4.04l-.723.724a1.125 1.125 0 01-1.298.21l-.153-.076a1.125 1.125 0 01-.622-1.006v-1.089c0-.298-.119-.585-.33-.796l-1.347-1.347a1.125 1.125 0 01-.21-1.298L9.75 12l-1.64-1.64a6 6 0 01-1.676-3.257l-.172-1.03z"
                                                clip-rule="evenodd" />
                                        </svg>

                                    </div>
                                </div>
                                <div class="w-full pl-4">
                                    <div class="flex justify-between mb-2">
                                        <h2 class="font-bold">{{ $tenant->id }}</h2>
                                        <div class="flex items-center px-2 py-1 text-xs bg-green-200 rounded-lg">
                                            <span class="relative mr-1.5 flex h-2.5 w-2.5">
                                                <span
                                                    class="relative inline-flex h-2.5 w-2.5 rounded-full bg-green-400"></span>
                                            </span>
                                            Active
                                        </div>
                                    </div>

                                    <div class="space-y-1">
                                        <div class="flex gap-2 text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                            </svg>
                                            <p class="text-xs">{{ $tenant->company }}</p>
                                        </div>
                                        <div class="flex gap-2 text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                                            </svg>
                                            <a href="{{ 'http://' . $tenant->domains()->first()?->domain }}"
                                                target="_blank"
                                                class="block text-xs">{{ 'http://' . $tenant->domains()->first()?->domain }}</a>
                                        </div>
                                        <div class="flex gap-2 text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                            </svg>
                                            <span class="text-xs">{{ $tenant->plan ?? 'Standard' }}</span>
                                        </div>
                                    </div>

                                </div>
                            </header>
                        </div>
                    @endforeach
                </div>
            @else
                <button x-data x-on:click="$dispatch('openmodal-create')" type="button"
                    class="relative block w-full p-12 text-center border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg class="w-12 h-12 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6" />
                    </svg>
                    <span class="block mt-2 text-sm font-medium text-gray-900">Create a new application</span>
                </button>
                <div>

                    <x-modal ref="create">
                        <x-slot name="title">{{ __('Create Application') }}</x-slot>
                        <div class="p">

                            @livewire('user.applications.create-application')

                        </div>
                    </x-modal>
                </div>
            @endif
        </div>
        <div>

            <h2 class="mb-4 text-xl font-bold">My Subscription</h2>

            @if (Auth::user()->subscribed())
                <div class="px-6 py-6 bg-white border rounded-md shadow-sm">
                    <div>
                        <div>
                            <span class="px-3 py-1 text-xs text-gray-900 bg-green-400 rounded-md">
                                Standard
                            </span>
                        </div>
                        <div>
                            <div class="flex gap-1 mt-2">
                                <div class="text-xl text-gray-600">$</div>
                                <div class="text-5xl font-bold text-gray-900">300</div>
                                <div class="self-end text-lg text-gray-600">/mo</div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t">
                        <a href="{{ url('billing') }}" class="text-sm font-bold text-indigo-500">Manage Subscription</a>
                    </div>
                </div>
            @endif

            @if (Auth::user()->onTrial())
                <div class="px-6 py-6 bg-white border rounded-md shadow-sm">
                    <div>
                        <div>
                            <span class="px-3 py-1 text-xs text-white bg-red-600 rounded-md">
                                Free Trial
                            </span>
                        </div>
                        <p class="mt-2 text-xs">Your free trial expires at
                            {{ auth()->user()->trial_ends_at->format('F d') }}.</p>
                    </div>

                    <div class="pt-4 mt-4 border-t">
                        <a href="{{ url('billing') }}" class="text-sm font-bold text-indigo-500">Upgrade Now</a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="rightHeader">
        <div class="grid grid-cols-2 gap-4">
            <form id="form-clinic">
                <x-form.select name="clinic_id" onchange="document.querySelector('#form-clinic').submit()">
                    <option value="">-- {{ __('All Clinic ') }} --</option>
                    @foreach($clinics as $clinic)
                    <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                    @endforeach
                </x-form.select>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <section>
                <div>
                    <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-2 lg:grid-cols-3">
                        <x-dashboard-widget>
                            <x-slot name="icon">

                            <!-- Heroicon name: outline/users -->
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            </x-slot>
                            <x-slot name="label">Patients</x-slot>
                            <p class="text-2xl font-semibold text-gray-900">{{ $total_patients }}</p>
                        </x-dashboard-widget>

                        <x-dashboard-widget>
                            <x-slot name="icon">
                                <x-heroicon-s-building-storefront class="w-6 h-6 text-white"/>
                            </x-slot>
                            <x-slot name="label">Pharmacy</x-slot>
                            <p class="text-2xl font-semibold text-gray-900">0</p>
                        </x-dashboard-widget>
                      
                    </dl>
                  </div>
                  
            </section>

            <div class="py-6">
                @livewire('patient.dashboard-patients')
            </div>
        </div>
    </div>
</x-app-layout>

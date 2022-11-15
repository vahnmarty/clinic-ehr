<div>
    
    <header class="flex justify-between">
        <h3 class="text-2xl font-bold">{{ __('Patient List') }}</h3>
        <div>
            <a href="{{ route('dashboard') }}" class="btn-primary">{{ __('Add New Patient') }}</a>
        </div>
    </header>
    <div class="mt-8 bg-white shadow-sm sm:rounded-lg">
        <div class="bg-white border-b border-gray-200 ">
           <x-table.table-wrapper/>
        </div>
    </div>
</div>
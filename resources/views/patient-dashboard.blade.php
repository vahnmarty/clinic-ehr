<x-app-layout>

    @section('title', 'Patients List')
    
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manage Patients') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <section>
                <div>
                    <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-2 lg:grid-cols-4">
                        <x-dashboard-widget class="bg-green-100 border-green-200">
                            <x-slot name="icon">

                            <!-- Heroicon name: outline/users -->
                            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            </x-slot>
                            <x-slot name="label">Patients</x-slot>
                            <p class="text-2xl font-semibold text-gray-900">{{ $total_patients }}</p>
                        </x-dashboard-widget>

                        <x-dashboard-widget class="bg-indigo-100 border-indigo-200">
                            <x-slot name="icon">
                                <x-heroicon-s-user class="w-6 h-6 text-white"/>
                            </x-slot>
                            <x-slot name="label">Male</x-slot>
                            <p class="text-2xl font-semibold text-gray-900">{{ $total_male }}</p>
                        </x-dashboard-widget>

                        <x-dashboard-widget class="bg-pink-100 border-pink-200">
                            <x-slot name="icon">
                                <x-heroicon-s-user class="w-6 h-6 text-white"/>
                            </x-slot>
                            <x-slot name="label">Female</x-slot>
                            <p class="text-2xl font-semibold text-gray-900">{{ $total_female }}</p>
                        </x-dashboard-widget>

                        <x-dashboard-widget class="bg-violet-100 border-violet-200">
                            <x-slot name="icon">
                                <x-heroicon-o-calendar class="w-6 h-6 text-white"/>
                                  
                                  
                            </x-slot>
                            <x-slot name="label">Active Today</x-slot>
                            <p class="text-2xl font-semibold text-gray-900">{{ $active }}</p>
                        </x-dashboard-widget>
                      
                    </dl>
                  </div>
                  
            </section>

            

            <div class="py-6">
                @livewire('manage-patients')
            </div>

            <div>
                <div class="grid grid-cols-4 gap-8 mt-8">
                    <div class="col-span-2 border">
                        <div class="py-4 bg-white">
                            <div id="chart-agegroups"></div>
                        </div>
                    </div>

                    <div class="col-span-2 border">
                        <div class="py-4 bg-white">
                            <div id="chart-gendergroups"></div>
                        </div>
                    </div>
                </div>
                <table id="datatable" class="hidden">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Male</th>
                            <th>Female</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($age_groups as $ageGroup)
                        <tr>
                            <th>{{ $ageGroup['group'] }} y.o</th>
                            <td>{{ $ageGroup['male'] }}</td>
                            <td>{{ $ageGroup['female'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    window.onload = (event) => {
        chartAgeGroups();
        chartGenderGroups({{ $total_male}}, {{ $total_female }});
    };

    function chartAgeGroups()
    {
        Highcharts.chart('chart-agegroups', {
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Age Groups and Gender'
            },
            xAxis: {
                type: 'category'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Total'
                }
            },
        });
        
    }

    function chartGenderGroups($total_male, $total_female)
    {
        Highcharts.chart('chart-gendergroups', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Gender',
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y}'
                    }
                }
            },
            series: [{
                name: 'Group',
                colorByPoint: true,
                data: [{
                    name: 'Male',
                    y: $total_male,
                }, {
                    name: 'Female',
                    y: $total_female,
                    color: 'pink'
                }]
            }]
        });

        
    }
      
</script>
@endpush
</x-app-layout>

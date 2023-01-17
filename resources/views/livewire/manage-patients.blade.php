<x-app-layout>

    @section('title', 'Manage Patients')
    
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
                                <x-heroicon-s-home class="w-6 h-6 text-white"/>
                            </x-slot>
                            <x-slot name="label">Clinics</x-slot>
                            <p class="text-2xl font-semibold text-gray-900">{{ $clinics->count() }}</p>
                        </x-dashboard-widget>

                        <x-dashboard-widget class="bg-orange-100 border-orange-200">
                            <x-slot name="icon">
                                <x-heroicon-s-database class="w-6 h-6 text-white"/>
                            </x-slot>
                            <x-slot name="label">Pharmacy</x-slot>
                            <p class="text-2xl font-semibold text-gray-900">{{ $total_pharmacy }}</p>
                        </x-dashboard-widget>

                        <x-dashboard-widget class="bg-violet-100 border-violet-200">
                            <x-slot name="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5l16.5-4.125M12 6.75c-2.708 0-5.363.224-7.948.655C2.999 7.58 2.25 8.507 2.25 9.574v9.176A2.25 2.25 0 004.5 21h15a2.25 2.25 0 002.25-2.25V9.574c0-1.067-.75-1.994-1.802-2.169A48.329 48.329 0 0012 6.75zm-1.683 6.443l-.005.005-.006-.005.006-.005.005.005zm-.005 2.127l-.005-.006.005-.005.005.005-.005.005zm-2.116-.006l-.005.006-.006-.006.005-.005.006.005zm-.005-2.116l-.006-.005.006-.005.005.005-.005.005zM9.255 10.5v.008h-.008V10.5h.008zm3.249 1.88l-.007.004-.003-.007.006-.003.004.006zm-1.38 5.126l-.003-.006.006-.004.004.007-.006.003zm.007-6.501l-.003.006-.007-.003.004-.007.006.004zm1.37 5.129l-.007-.004.004-.006.006.003-.004.007zm.504-1.877h-.008v-.007h.008v.007zM9.255 18v.008h-.008V18h.008zm-3.246-1.87l-.007.004L6 16.127l.006-.003.004.006zm1.366-5.119l-.004-.006.006-.004.004.007-.006.003zM7.38 17.5l-.003.006-.007-.003.004-.007.006.004zm-1.376-5.116L6 12.38l.003-.007.007.004-.004.007zm-.5 1.873h-.008v-.007h.008v.007zM17.25 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zm0 4.5a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                  </svg>
                                  
                                  
                            </x-slot>
                            <x-slot name="label">Laboratory</x-slot>
                            <p class="text-2xl font-semibold text-gray-900">{{ $total_laboratory }}</p>
                        </x-dashboard-widget>
                      
                    </dl>
                  </div>
                  
            </section>

            

            <div class="py-6">
                
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

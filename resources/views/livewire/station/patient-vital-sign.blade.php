<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Station 3: {{ __('Vital Signs') }}
    </h2>
    <x-slot name="rightHeader">
        <div x-data class="flex justify-end">
            <button type="button" class="btn-secondary" x-on:click="$dispatch('openmodal-search')">Search Patient</button>
        </div>
    </x-slot>
</x-slot>

<div>
    @if ($patient_id)
        @if ($patient)
            <div class="wrapper">
                <div class="py-6">
                    <div class="p-4 bg-white rounded-md">
                        <div class="flex">
                            <div class="w-20 h-20 overflow-hidden border-2 rounded-full shadow-lg">
                                <img src="{{ $patient->image_avatar }}" class="w-20 h-20" alt="">
                            </div>
                            <div class="pl-4">
                                <p>
                                    <strong>Name: </strong>
                                    <span>{{ $patient->first_name }} {{ $patient->last_name }}</span>
                                </p>
                                <p>
                                    <strong>Birthday: </strong>
                                    <span>{{ $patient->date_of_birth }}
                                        ({{ Carbon\Carbon::parse($patient->date_of_birth)->age }} yrs old) </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section>
                <header class="py-6 bg-gray-300">
                    <div class="wrapper">
                        <h1 class="text-xl font-bold">{{ __('Anthropometric Calculator') }}</h1>
                    </div>
                </header>
                <div class="py-12 bg-gray-100">
                    <div class="space-y-8 wrapper">
                        <div class="grid grid-cols-4 gap-6">
                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Date of Birth') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-text wire:model="date_of_birth" required class="bg-gray-200" readonly />
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Date of Visit') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-text wire:model="date_of_visit" required class="bg-gray-200" readonly />
                                <x-input-error :messages="$errors->get('date_of_visit')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Age (in days)') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-text wire:model="age_in_days" required class="bg-gray-200" readonly />
                                <x-input-error :messages="$errors->get('age_in_days')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('BMI') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-text wire:model="bmi" required class="bg-gray-200" readonly />
                                <x-input-error :messages="$errors->get('bmi')" class="mt-2" />
                            </x-form.form-group>
                        </div>
                        <div class="grid grid-cols-4 gap-6">

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Height') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-group>
                                    <x-form.input-text wire:model="height" required />
                                    <x-slot name="rightAddon">
                                        <small>cm</small>
                                    </x-slot>
                                </x-form.input-group>
                                <x-input-error :messages="$errors->get('height')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Weight') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-group>
                                    <x-form.input-text wire:model="weight" required />
                                    <x-slot name="rightAddon">
                                        <small>kg</small>
                                    </x-slot>
                                </x-form.input-group>
                                <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Head Circumference') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-group>
                                    <x-form.input-text wire:model="head_circumference" required />
                                    <x-slot name="rightAddon">
                                        <small>cm</small>
                                    </x-slot>
                                </x-form.input-group>
                                <x-input-error :messages="$errors->get('head_circumference')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('MUAC') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-group>
                                    <x-form.input-text wire:model="muac" required />
                                    <x-slot name="rightAddon">
                                        <small>cm</small>
                                    </x-slot>
                                </x-form.input-group>
                                <x-input-error :messages="$errors->get('muac')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Tricep Skinfold') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-group>
                                    <x-form.input-text wire:model="tricep_skinfold" required />
                                    <x-slot name="rightAddon">
                                        <small>mm</small>
                                    </x-slot>
                                </x-form.input-group>
                                <x-input-error :messages="$errors->get('tricep_skinfold')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Subscapular Skinfold') }}
                                    <x-required />
                                </x-slot>
                                <x-form.input-group>
                                    <x-form.input-text wire:model="subscapular_skinfold" required />
                                    <x-slot name="rightAddon">
                                        <small>mm</small>
                                    </x-slot>
                                </x-form.input-group>
                                <x-input-error :messages="$errors->get('subscapular_skinfold')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Edema') }}
                                    <x-required />
                                </x-slot>
                                <div class="flex gap-4 py-2">
                                    <label>
                                        <input type="radio" wire:model="edema" value="1">
                                        <span>{{ __('Yes') }}</span>
                                    </label>
                                    <label>
                                        <input type="radio" wire:model="edema" value="0">
                                        <span>{{ __('No') }}</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('tricep_circumference')" class="mt-2" />
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-slot name="label">
                                    {{ __('Measured Recumbent') }}
                                    <x-required />
                                </x-slot>
                                <div class="flex gap-4 py-2">
                                    <label>
                                        <input type="radio" wire:model="measured_recumbent" value="1">
                                        <span>{{ __('Yes') }}</span>
                                    </label>
                                    <label>
                                        <input type="radio" wire:model="measured_recumbent" value="0">
                                        <span>{{ __('No') }}</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('tricep_circumference')" class="mt-2" />
                            </x-form.form-group>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <header class="py-6 bg-gray-300">
                    <div class="wrapper">
                        <div class="flex items-center justify-between">
                            <h1 class="text-xl font-bold">{{ __('Results') }}</h1>
                            <button type="button" class="btn-secondary"
                                wire:click="calculator">{{ __('Calculate') }}</button>
                        </div>
                    </div>
                </header>
                <div class="py-6 bg-gray-100">
                    <div class="wrapper">

                        <div class="grid gap-8 sm:grid-cols-2">
                            @foreach (collect($results)->chunk(4) as $chunk)
                                <div class="space-y-8">
                                    @foreach ($chunk as $title => $widget)
                                        <div class="flex justify-between gap-8 p-4 rounded-md shadow-sm bg-green-50">
                                            <div class="flex-1">
                                                <div class="flex justify-between mt-1">
                                                    <label
                                                        class="text-xs font-bold uppercase">{{ Str::title($title) }}</label>
                                                    <div class="text-xs font-bold">{{ $widget['centile'] }}%</div>
                                                </div>
                                                <div
                                                    class="mb-4 mt-4 h-1.5 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                                                    <div class="h-1.5 rounded-full bg-blue-600 dark:bg-blue-500"
                                                        style="width: {{ $widget['centile'] }}%"></div>
                                                </div>
                                            </div>
                                            <div class="flex w-32 gap-4">
                                                <div>
                                                    <label class="text-xs font-bold uppercase">Z-Score</label>
                                                    <div class="p-2 mt-1 text-sm bg-white">
                                                        {{ round($widget['value'], 2) }}</div>
                                                </div>
                                                @if (!empty($widget['chart']))
                                                    <button
                                                        onclick="initChart(
                                                `{{ $widget['chart']['title'] }}`, 
                                                `{{ $widget['chart']['x'] }}`, 
                                                `{{ $widget['chart']['y'] }}`, 
                                                `{{ $widget['chart']['dataset'] }}`)"
                                                        type="button" class="self-end">
                                                        <img src="{{ url('img/icons/export.png') }}"
                                                            class="w-10 h-10 duration-300 ease-in scale-75 hover:scale-100"
                                                            alt="">
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-8" id="chart-container">
                            <div id="chart"></div>
                        </div>

                        <div class="flex justify-center mt-8">
                            <button type="button" class="btn-secondary"
                                wire:click="save">{{ __('Save Results') }}</button>
                        </div>

                    </div>
                </div>
            </section>

            <section>
                <header class="py-6 bg-gray-300">
                    <div class="wrapper">
                        <h1 class="text-xl font-bold">{{ __('Historical Vitals') }}</h1>
                    </div>
                </header>
                <div class="py-6 bg-gray-100">
                    <div class="wrapper">

                        <x-table.table-wrapper>
                            <thead class="bg-gray-50">
                                <tr>
                                    <x-table.th class="text-center">
                                        <input type="checkbox">
                                    </x-table.th>
                                    <x-table.th>{{ __('Date Collected') }}</x-table.th>
                                    <x-table.th>{{ __('Height') }}</x-table.th>
                                    <x-table.th>{{ __('Weight') }}</x-table.th>
                                    <x-table.th>{{ __('HC') }}</x-table.th>
                                    <x-table.th>{{ __('W/L') }}</x-table.th>
                                    <x-table.th>{{ __('W/A') }}</x-table.th>
                                    <x-table.th>{{ __('H/A') }}</x-table.th>
                                    <x-table.th>{{ __('L/A') }}</x-table.th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($history as $item)
                                    <tr>
                                        <x-table.td class="text-center">
                                            <input type="checkbox">
                                        </x-table.td>
                                        <x-table.td>{{ $item->date_of_visit }}</x-table.td>
                                        <x-table.td>{{ $item->height }}</x-table.td>
                                        <x-table.td>{{ $item->weight }}</x-table.td>
                                        <x-table.td>{{ $item->head_circumference }}</x-table.td>
                                        <x-table.td>{{ $item->weight_for_length }}</x-table.td>
                                        <x-table.td>{{ $item->weight_for_age }}</x-table.td>
                                        <x-table.td>{{ $item->hc_for_age }}</x-table.td>
                                        <x-table.td>{{ $item->length_for_age }}</x-table.td>
                                        <x-table.td></x-table.td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table.table-wrapper>

                    </div>
                </div>
            </section>

        @endif

    @endif
</div>

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- 
    TODO: fetch json from <script> file
    - so don't need to use fetch()
    https://stackoverflow.com/questions/19706046/how-to-read-an-external-local-json-file-in-javascript 
-->

<script>


    //initChart('Weight for Age', 'Weight (kg)', 'Height (cm)', 'wfl_boys_sd');

    function initChart($title, $xAxis, $yAxis, $dataset)
    {
        let url = "{{ url('data/SD_Tables') }}/" + $dataset + '.json';

        fetch(url)
        .then(res => res.json())
        .then(data =>
            createChart($title, $xAxis, $yAxis, data))
            
        .catch(err => { throw err });
    }

    function createChart($title, $xAxis, $yAxis, $dataset)
    {
        let table = $dataset;

        let SD4_SD3 = [];
        let SD3_SD2 = [];
        let SD2_SD1 = [];
        let SD1_nSD1 = [];
        let nSD1_nSD2 = [];
        let nSD2_nSD3 = [];
        let nSD3_nSD4 = [];
        let SD0 = [];


        
        
        for (let key = 0; key < Object.keys(table).length; key += 10) {
            let num = Object.keys(table)[key];
            let obj = table[num];
            SD4_SD3.push([Number(num), obj.SD4, obj.SD3]);
            SD3_SD2.push([Number(num), obj.SD3, obj.SD2]);
            SD2_SD1.push([Number(num), obj.SD2, obj.SD1]);
            SD1_nSD1.push([Number(num), obj.SD1, obj.SD1neg]);
            nSD1_nSD2.push([Number(num), obj.SD1neg, obj.SD2neg]);
            nSD2_nSD3.push([Number(num), obj.SD2neg, obj.SD3neg]);
            nSD3_nSD4.push([Number(num), obj.SD3neg, obj.SD4neg]);
            SD0.push([Number(num), obj.SD0]);
        }
        
        Highcharts.chart('chart', {
            title: {
                text: $title
            },
            credits: false,
      legend: {
        enabled: false,
      },
            xAxis: {
                allowDecimals: false,
                title:{
                    text: $xAxis
                },
                plotLines:
                [{
                color: '#FF0000',
                width: 5,
                value: 75, //php here
                zIndex: 5,
                }]
            },
            yAxis: {
                title:
                {
                text: $yAxis,
                },
                plotLines:
                [{
                color: '#FF0000',
                width: 5,
                value: 9, // php here
                zIndex: 5,
                }]
            },
            plotOptions: {
                area: {
                    pointStart: 1940,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            series: [
                getSeries('arearange', '+3 SD', SD4_SD3, '#000000'),
                getSeries('arearange', '+2 SD', SD3_SD2, '#d64242'),
                getSeries('arearange', '+1 SD', SD2_SD1, '#f9ff32'),
                getSeries('arearange', '+1 SD', SD1_nSD1, '#69fe35'),
                getSeries('arearange', '-1 SD', nSD1_nSD2, '#f9ff32'),
                getSeries('arearange', '-2 SD', nSD2_nSD3, '#d64242'),
                getSeries('arearange', '-3 SD', nSD3_nSD4, '#000000'),
                getSeries('line', 'Median', SD0, 'black'),
            ]
        });

        document.getElementById('chart-container').scrollIntoView({
            behavior: 'smooth'
          });
    }

    

    function getSeries($type, $label, $data, $color)
    {
        return {
            type: $type,
            name: $label,
            data: $data,
            lineWidth: 1,
            color: $color,
            animation: false,
            fillOpacity: 0.8,
            enableMouseTracking: false,
            marker: {
              radius: 0
            },
          };
    }
</script>
@endpush

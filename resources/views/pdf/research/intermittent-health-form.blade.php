@extends('layouts.pdf')

@section('content')
    <div class="px-8">
        @include('pdf.research._header')
        <div class="text-center">
            <h1 class="text-3xl font-bold uppercase">Intermittent Health Form</h1>
        </div>
        <div class="space-y-8">
            <div>
                <h3>1. Has the baby had diarrhea in the last two weeks?</h3>
                <fieldset class="flex flex-col pl-4">
                    @foreach (\App\Enums\BooleanOption::asSelectArray() as $int => $string)
                        <label>
                            @if ($form->has_diarrhea == $int)
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                            <span>{{ $string }}</span>
                        </label>
                    @endforeach
                </fieldset>
            </div>

            <div>
                <h3>2. Has the baby had stools with blood or mucus?</h3>
                <fieldset class="flex flex-col pl-4">
                    @foreach (\App\Enums\BooleanOption::asSelectArray() as $int => $string)
                        <label>
                            @if ($form->has_diarrheal_stools == $int)
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                            <span>{{ $string }}</span>
                        </label>
                    @endforeach
                </fieldset>
            </div>

            <div>
                <h3>3. Has the baby presented more than three diarrheal stools or liquid stools in the last two weeks?</h3>
                <fieldset class="flex flex-col pl-4">
                    @foreach (\App\Enums\BooleanOption::asSelectArray() as $int => $string)
                        <label>
                            @if ($form->has_toilet == $int)
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                            <span>{{ $string }}</span>
                        </label>
                    @endforeach
                </fieldset>
            </div>

            <div>
                <h3>4. Has the baby gone to the toilet more times than usual (even if stools are normal) in the last two
                    weeks?</h3>
                <fieldset class="flex flex-col pl-4">
                    @foreach (\App\Enums\BooleanOption::asSelectArray() as $int => $string)
                        <label>
                            @if ($form->has_diagnosed_gastrointestinal == $int)
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                            <span>{{ $string }}</span>
                        </label>
                    @endforeach
                </fieldset>
            </div>

            <div>
                <h3>5. Has the baby presented with any of the following in the last two weeks? </h3>
                <fieldset class="flex flex-col pl-4">
                    @foreach (\App\Enums\BooleanOption::asSelectArray() as $int => $string)
                        <label>
                            @if ($form->has_presented_anything == $int)
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                            <span>{{ $string }}</span>
                        </label>
                    @endforeach
                </fieldset>
            </div>

            <div>
                <h3>6. How long does the diarrhea last?</h3>
                <p class="table w-full pl-4 mt-1">
                    <span class="table-cell border-b-2 border-gray-900">{{ $form->diarrhea_last }}</span>
                </p>
            </div>

            <div>
                <h3>7. Has the baby presented with any of the following in the last two weeks? </h3>
                <fieldset class="flex flex-col pl-4">
                    @foreach ($form->getFieldset1() as $var => $label)
                        <label>
                            @if ($form->$var)
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </fieldset>
                <p class="pl-4 mt-1">If hospitalized, number of days hospitalized? <span
                        class="font-bold underline">{{ $form->days_hospitalized }}</span></p>

            </div>

            <p style="page-break-after: always;">&nbsp;</p>

            <div>
                <h3>8. Have you noticed any of the following symptoms after eating a certain food?</h3>
                <fieldset class="flex flex-col pl-4">
                    @foreach ($form->getFieldset2() as $var => $label)
                        <label>
                            @if ($form->$var)
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </fieldset>

            </div>

        </div>
    </div>
@endsection

@extends('layouts.pdf')

@section('content')
    <div class="px-8">
        @include('pdf.research._header')
        <div class="text-center">
            <h1 class="text-3xl font-bold uppercase">Maternal Health Questionairre</h1>
        </div>
        <div class="grid grid-cols-2 gap-8 mt-8">
            <div class="table w-full">
                <span class="table-cell w-40">1. Mother's Height</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->mother_height }} cm</span>
            </div>

            <div class="table w-full">
                <span class="table-cell w-40">2. Mother's Weight</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->mother_weight }} kg</span>
            </div>

            <div class="table w-full">
                <span class="table-cell w-40">3. Abdominal Circumference</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->abdominal_circumference }} cm</span>
            </div>
            <div class="table w-full">
                <span class="table-cell w-40">4. BMI</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->bmi }}</span>
            </div>
            <div class="table w-full">
                <span class="table-cell w-40">5. Highest Level of Schooling</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->highest_schooling }}</span>
            </div>
            <div class="table w-full">
                <span class="table-cell w-40">6. Occupation</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->occupation }}</span>
            </div>

            <div class="table w-full">
                <span class="table-cell w-40">7. Marital Relationship</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->marital_relationship }}</span>
            </div>
        </div>

        <h3 class="mt-4 mb-4 text-xl font-bold">Maternal Gyn History</h3>

        <div class="grid grid-cols-2 gap-8 mt-8">
            <div class="table w-full">
                <span class="table-cell w-40">8. Age at Menarche: (years)</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->menarche_age }}</span>
            </div>
            <div class="table w-full">
                <span class="table-cell w-40">9. Last Menstrual Period</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->last_menstrual_period }}</span>
            </div>
            <div class="table w-full">
                <span class="table-cell w-40">10. Cycle Length</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->menstrual_cycle_length }}</span>
            </div>
            <div class="table w-full">
                <span class="table-cell w-40">11. Duration of flow</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->menstrual_duration_flow }}</span>
            </div>
            <div class="table w-full">
                <span class="table-cell w-40">12. Amount of flow</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->menstrual_amount_flow }}</span>
            </div>
        </div>

        <div class="mt-8 space-y-8">
            <div class="grid grid-cols-3 gap-4">

                @foreach ($form->getFieldset1() as $var => $label)
                    <fieldset class="">
                        <p>{{ $loop->index + 13 }}. {{ $label }}</p>
                        <div class="mt-1 mb-3 space-y-4">
                            @foreach (\App\Enums\BooleanOption::asSelectArray() as $int => $string)
                                <label>
                                    @if ($form->$var == $int)
                                        <input type="checkbox" checked>
                                    @else
                                        <input type="checkbox">
                                    @endif
                                    <span>{{ $string }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                @endforeach

                <div class="col-span-3">
                    <div class="table w-full">
                        <span class="table-cell w-40">18. Bleeding Pattern</span>
                        <span class="table-cell pl-4 border-b border-gray-900">{{ $form->bleeding_pattern }}</span>
                    </div>
                </div>

                <fieldset>
                    <p>19. Are you on contraception?</p>
                    <div class="mt-1 mb-3 space-y-4">
                        @foreach (\App\Enums\BooleanOption::asSelectArray() as $int => $string)
                            <label>
                                @if ($form->is_using_contraception == $int)
                                    <input type="checkbox" checked>
                                @else
                                    <input type="checkbox">
                                @endif
                                <span>{{ $string }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                <div>
                    <div class="table w-full">
                        <span class="table-cell w-40">20. Which method?</span>
                        <span class="table-cell pl-4 border-b border-gray-900">{{ $form->contraception_method }}</span>
                    </div>
                </div>

                <div class="col-span-3">
                    <div class="table w-full">
                        <span class="table-cell w-40">21. Previous methods use?</span>
                        <span class="table-cell pl-4 border-b border-gray-900">{{ $form->previous_contraception }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

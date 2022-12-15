@extends('layouts.pdf')

@section('content')
    <div class="px-8">
        @include('pdf.research._header')
        <div class="text-center">
            <h1 class="text-3xl font-bold uppercase">Maternal Health Questionairre</h1>
        </div>
        <div class="grid grid-cols-2 gap-8 mt-8">
            <div class="table w-full">
                <span class="table-cell w-48">1. Mother's Height</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->mother_height }} cm</span>
            </div>

            <div class="table w-full">
                <span class="table-cell w-48">2. Mother's Weight</span>
                <span class="table-cell pl-4 border-b border-gray-900">{{ $form->mother_weight }} kg</span>
            </div>
            
        </div>
        <div class="mt-8 space-y-8">
            

        </div>
    </div>
@endsection

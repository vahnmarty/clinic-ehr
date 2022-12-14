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
                <strong>Patient #: </strong>
                <span>{{ $patient->patient_number }}</span>
            </p>
            <p>
                <strong>Birthday: </strong>
                <span>{{ $patient->date_of_birth }}
                    ({{ Carbon\Carbon::parse($patient->date_of_birth)->age }} yrs old) </span>
            </p>
        </div>
    </div>
</div>
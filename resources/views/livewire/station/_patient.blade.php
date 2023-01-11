<div class="flex items-center justify-between p-4 pr-8 border-2 border-blue-300 rounded-md shadow-lg bg-blue-50">
    <div class="flex">
        <div class="w-20 h-20 overflow-hidden border-2 rounded-full shadow-lg">
            <img src="{{ $patient->image_avatar }}" class="w-20 h-20" alt="">
        </div>
        <div class="pl-4">
            <p>
                <strong>Name: </strong>
                <span>{{ $patient->first_name }} {{ $patient->last_name }}</span>
                <a href="{{ route('patient.show', $patient->id) }}" class="btn-icon">View</a>
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
    <div>
        @if($patient->latestApp)
        <nav aria-label="Progress" class="-mt-2">
            <ol role="list" class="flex items-center">
                <x-progress-item 
                    label="Check-in" 
                    link="{{ route('station.checkin', ['patientId' => $patient->id]) }}" 
                    :done="$patient->latestApp?->check_in_at ? true : false" />
                <x-progress-item 
                    label="Vitals" 
                    link="{{ route('station.vital-sign', ['patientId' => $patient->id]) }}" 
                    :done="$patient->latestApp?->vital_sign_finished_at ? true : false" />

                <x-progress-item 
                    label="Public Health" 
                    link="{{ route('station.research', ['patientId' => $patient->id]) }}" 
                    :done="$patient->latestApp?->research_form_finished_at ? true : false" />

                <x-progress-item 
                    label="Encounter" 
                    link="{{ route('station.clinical-encounter', ['patientId' => $patient->id]) }}" 
                    :done="$patient->latestApp?->clinic_encounter_finished_at ? true : false" />

                <x-progress-item 
                    label="Orders" 
                    link="{{ route('station.pharmacy-order', ['patientId' => $patient->id]) }}" 
                    :done="$patient->latestApp?->pharmacy_order_finished_at ? true : false"
                    :last="true" />
                    
            </ol>
        </nav>
        @else
        @if(!Route::is('station.checkin'))
        <a href="{{ route('station.checkin', ['patientId' => $patient->id]) }}" class="btn-primary">Check In Patient</a>
        @endif
        @endif
    </div>
</div>
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
                <x-progress-item label="Check-in" :done="$patient->latestApp->check_in_at ? true : false"/>
                <x-progress-item label="Vitals" :done="$patient->latestApp->vital_sign_finished_at ? true : false"/>
                <x-progress-item label="Public Health" :done="$patient->latestApp->research_form_finished_at ? true : false"/>
                <x-progress-item label="Encounter" :done="$patient->latestApp->clinic_encounter_finished_at ? true : false"/>
                <x-progress-item label="Orders" :done="$patient->latestApp->pharmacy_order_finished_at ? true : false" :last="true"/>
            </ol>
        </nav>
        @else
        <nav aria-label="Progress" class="-mt-2">
            <ol role="list" class="flex items-center">
                <x-progress-item label="Check-in" :done="false" />
                <x-progress-item label="Vitals"  :done="false" />
                <x-progress-item label="Public Health" :done="false" />
                <x-progress-item label="Encounter" :done="false" />
                <x-progress-item label="Orders" :done="false" :last="true" />
            </ol>
        </nav>
        @endif
    </div>
</div>
<div>
    @livewire('station.patient-medical-problems', ['patientId' => $patient_id])
    @livewire('station.patient-current-medications', ['patientId' => $patient_id])
    @livewire('station.patient-allergies', ['patientId' => $patient_id])
    @livewire('station.patient-prenatal-history', ['patientId' => $patient_id])
</div>

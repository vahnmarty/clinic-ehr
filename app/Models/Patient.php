<?php

namespace App\Models;

use Storage;
use App\Enums\RacialIdentity;
use App\Enums\PrimaryLanguage;
use App\Models\MedicalProblem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [ 'full_name', 'image_avatar', 'age', 'app_status' ];

    protected $casts = [
        'identity' => RacialIdentity::class,
        'primary_language' => PrimaryLanguage::class,
    ];

    public function getAvatar()
    {
        if($this->avatar){
            return Storage::disk('local')->url($this->avatar);

        }else{
            return "https://ui-avatars.com/api/?name=" . $this->getFullName();
        }
    }

    public function getImageAvatarAttribute()
    {
        return $this->getAvatar();
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullNameAttribute(){
        return $this->getFullName();
    }

    public function getAddress()
    {
        $array = [$this->address1, $this->city, $this->state, $this->zip_code, $this->country];
        return implode(', ', $array);
    }

    public function scopeFromClinic($query, $clinic_id){
        return $query->clinics->wherePivot('clinic_id', $clinic_id);
    }

    public function scopeSearch($query, $keyword){
        return $query->where('patient_number', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $keyword . '%');
    }

    public function scopeMale($query){
        return $query->where('sex', 'male');
    }

    public function scopeFemale($query){
        return $query->where('sex', 'female');
    }

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class, 'clinic_patients');
    }

    public function medicalProblems()
    {
        return $this->hasMany(MedicalProblem::class);
    }

    public function medications()
    {
        return $this->hasMany(Medication::class);
    }

    public function guardians()
    {
        return $this->hasMany(Guardian::class);
    }

    public function prenatal()
    {
        return $this->hasOne(PrenatalHistory::class);
    }

    public function allergies()
    {
        return $this->hasMany(Allergy::class);
    }

    public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }

    public function vitalSigns()
    {
        return $this->hasMany(VitalSign::class);
    }

    public function planMedications()
    {
        return $this->hasMany(PlanMedication::class);
    }

    public function medicalCodings()
    {
        return $this->hasMany(MedicalCoding::class);
    }

    public function planLaboratories()
    {
        return $this->hasMany(PlanLaboratory::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }


    public function latestApp() {
        return $this->hasOne(Application::class)->latest();
    }

    public function getAppStatusAttribute()
    {
        return $this->latestApp?->status;
    }

    public function scopeActive($query)
    {
        return $query->whereNotNull('id');
    }

    public function scopeWithApplication($query){
        return $query->leftJoin('applications', 'patients.id', '=', 'applications.patient_id')
                    ->select('patients.*', 'applications.clinic_id', 'applications.pharmacy_order_finished_at');
    }

    public function scopeStatusPharmacyOrder($query){
        return $query->whereNotNull('pharmacy_order_finished_at');
    }

    public function scopeStatusClinicEncounter($query){
        return $query->whereNotNull('clinic_encounter_finished_at');
    }

    public function scopeStatusResearchForm($query){
        return $query->whereNotNull('research_form_finished_at');
    }

    public function scopeStatusVitalSign($query){
        return $query->whereNotNull('vital_sign_finished_at');
    }

    public function scopeStatusPatientInfo($query){
        return $query->whereNotNull('patient_info_finished_at');
    }
}

<?php

namespace App\Models;

use Storage;
use App\Models\MedicalProblem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getAvatar()
    {
        if($this->avatar){

            return Storage::disk('local')->url($this->avatar);

        }else{
            return "https://ui-avatars.com/api/?name=" . $this->getFullName();
        }
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAddress()
    {
        $array = [$this->address1, $this->city, $this->state, $this->zip_code, $this->country];
        return implode(', ', $array);
    }

    public function scopeFromClinic($query, $clinic_id){
        return $query->clinics->wherePivot('clinic_id', $clinic_id);
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
}

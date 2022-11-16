<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

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

    public function scopeFromClinic($query, $clinic_id){
        return $query->clinics->wherePivot('clinic_id', $clinic_id);
    }

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class, 'clinic_patients');
    }
}

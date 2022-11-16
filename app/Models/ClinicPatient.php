<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicPatient extends Model
{
    use HasFactory;

    protected $table = 'clinic_patients';

    protected $guarded = [];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

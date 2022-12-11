<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class MedicalCode extends Model
{
    use CentralConnection;
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['option_result'];

    public function scopeSearch($query, $keyword)
    {
        return $query->where('code3', 'LIKE', '%' . $keyword. '%')
                    ->orWhere('description1', 'LIKE' , '%' . $keyword . '%');
    }

    public function getOptionResultAttribute()
    {
        return $this->code3 . ' - ' . $this->description1;
    }
}

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
}

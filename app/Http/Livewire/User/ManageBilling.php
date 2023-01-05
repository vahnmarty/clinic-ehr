<?php

namespace App\Http\Livewire\User;

use Auth;
use App\Models\User;
use Livewire\Component;

class ManageBilling extends Component
{
    public function render()
    { 
        return view('livewire.user.manage-billing')->layout('layouts.user');
    }
    
}

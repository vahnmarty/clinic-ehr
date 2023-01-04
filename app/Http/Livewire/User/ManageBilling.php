<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Auth;

class ManageBilling extends Component
{
    public $checkout;
    
    protected $queryString = ['checkout'];

    public function render()
    {
        dd(Auth::user()->subscribed()); 
        return view('livewire.user.manage-billing')->layout('layouts.user');
    }
}

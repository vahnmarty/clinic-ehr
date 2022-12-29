<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Tenant;

class Dashboard extends Component
{
    public $tenants = [];

    public function render()
    {
        return view('livewire.user.dashboard')->layout('layouts.user');
    }

    public function mount()
    {
        $this->tenants = auth()->user()->tenants;
    }
}

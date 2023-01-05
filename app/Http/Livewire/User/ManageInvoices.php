<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Auth;

class ManageInvoices extends Component
{
    public function render()
    {
        $invoices = Auth::user()->invoices();
        return view('livewire.user.manage-invoices', compact('invoices'));
    }
}

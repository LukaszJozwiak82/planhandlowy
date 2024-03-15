<?php

namespace App\Livewire\Employee;

use Livewire\Component;

class Sale extends Component
{
    public $user;
    public function mount(){
        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.employee.sale');
    }
}

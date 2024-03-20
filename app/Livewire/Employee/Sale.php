<?php

namespace App\Livewire\Employee;

use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Services\Employee\SaleService;
use Livewire\Component;

class Sale extends Component
{
    public $user;
    public $users;
    public $recommended;
    public $headers = [
        ['key' => 'actual_date', 'label' => 'Data'],
        ['key' => 'recommended', 'label' => 'Rekomendacja'],
        ['key' => 'client.modulo', 'label' => 'Modulo'],
        ['key' => 'points', 'label' => 'Punkty'],

    ];
    public $sales;

    public function mount(SaleService $saleService){
        $this->user = auth()->user();
        $this->sales = $saleService->index($this->user);
    }

    public function render()
    {
        return view('livewire.employee.sale');
    }
}

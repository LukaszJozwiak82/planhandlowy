<?php

namespace App\Livewire\Employee;

use App\Helpers\PlanData;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Services\Employee\SaleService;
use Carbon\Carbon;
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
    public $sales = [];
    public $selectedTab;
    public $selectedYear;
    public $selectedQuarter;
    public $dates;
    public array $years;
    public array $quarters;
    public $sale;



    public function mount(){
        $this->user = auth()->user();
        $this->dates = PlanData::getQuarterData(1, Carbon::now()->year);
        $this->selectedYear = Carbon::now()->year;
        $this->selectedQuarter = Carbon::now()->quarter;
        $this->years  = [
            ['id' => Carbon::now()->year,'name' => Carbon::now()->year],
            ['id' => Carbon::now()->subYear()->year,'name' => Carbon::now()->subYear()->year],
        ];
        $this->quarters = [
            ['id' => 1,'name' => 'I'],
            ['id' => 2,'name' => 'II'],
            ['id' => 3,'name' => 'III'],
            ['id' => 4,'name' => 'IV'],
        ];
    }

    public function search(SaleService $saleService){
        $this->sales = $saleService->search($this->user, $this->selectedYear, $this->selectedQuarter);
    }

    public function delete(SaleService $saleService, $id){
        $saleService->delete($id);
        $this->search($saleService);
    }

    public function render()
    {
        return view('livewire.employee.sale');
    }
}

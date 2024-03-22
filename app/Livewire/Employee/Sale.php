<?php

namespace App\Livewire\Employee;

use App\Helpers\PlanData;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Services\Employee\SaleService;
use Carbon\Carbon;
use Illuminate\Support\Arr;
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

    public array $myChart = [
        'type' => 'pie',
        'data' => [
            'labels' => ['Mary', 'Joe', 'Ana'],
            'datasets' => [
                [
                    'label' => '# of Votes',
                    'data' => [12, 19, 3],
                ]
            ]
        ]
    ];

    public function randomize()
    {
        Arr::set($this->myChart, 'data.datasets.0.data', [fake()->randomNumber(2), fake()->randomNumber(2), fake()->randomNumber(2)]);
    }

    public function switch()
    {
        $type = $this->myChart['type'] == 'bar' ? 'pie' : 'bar';
        Arr::set($this->myChart, 'type', $type);
    }

    public function render()
    {
        return view('livewire.employee.sale');
    }
}

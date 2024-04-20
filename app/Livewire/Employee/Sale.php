<?php

namespace App\Livewire\Employee;

use App\Helpers\PlanData;
use App\Services\Employee\SaleService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Sale extends Component
{
    use WithPagination;

    public $user;

    public $users;
    public $recommended;

    public $headers = [
        ['key' => 'actual_date', 'label' => 'Data'],
        ['key' => 'recommended', 'label' => 'Rekomendacja'],
        ['key' => 'client.modulo', 'label' => 'Modulo'],
        ['key' => 'points', 'label' => 'Punkty'],

    ];

    public $selectedTab;
    public $selectedYear;
    public $selectedQuarter;
    public $dates;
    public array $years;
    public array $quarters;

    public function mount()
    {
        $this->user = auth()->user();
        $this->dates = PlanData::getQuarterData(1, Carbon::now()->year);
        $this->selectedYear = Carbon::now()->year;
        $this->selectedQuarter = Carbon::now()->quarter;
        $this->years = [
            ['id' => Carbon::now()->year, 'name' => Carbon::now()->year],
            ['id' => Carbon::now()->subYear()->year, 'name' => Carbon::now()->subYear()->year],
        ];
        $this->quarters = [
            ['id' => 1, 'name' => 'I'],
            ['id' => 2, 'name' => 'II'],
            ['id' => 3, 'name' => 'III'],
            ['id' => 4, 'name' => 'IV'],
        ];
    }

    public function search()
    {
        $this->resetPage();
    }

    public function show(SaleService $saleService, $id)
    {
        dd($id);
    }

    public function delete(SaleService $saleService, $id)
    {
        $saleService->delete($id);
        $this->search();
    }

    public function render(SaleService $saleService)
    {
        $sales = $saleService->search($this->user, $this->selectedYear, $this->selectedQuarter);

        return view('livewire.employee.sale', [
            'sales' => $sales,
        ]);
    }
}

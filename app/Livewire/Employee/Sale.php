<?php
declare(strict_types=1);

namespace App\Livewire\Employee;

use App\Helpers\PlanData;
use App\Models\User;
use App\Services\Employee\SaleService;
use Carbon\Carbon;
use Illuminate\View\View;
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

    public $selectedYear;
    public $selectedQuarter;
    public $selectedUser;
    public $dates;
    public array $years;
    public array $quarters;

    public function mount()
    {
        $this->selectedUser = "";
        if (auth()->user()->hasRole(['super-manager', 'admin'])) {
            $this->users = User::role('employee')->get();
        }
        if (auth()->user()->hasRole(['employee', 'manager'])) {
            $this->users = auth()->user()->departament->user()->role('employee')->get();
        }
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

    public function search(): void
    {
        $this->resetPage();
    }

    public function show($id): void
    {
        $this->dispatch('show-modal', saleId: $id);
    }

    public function delete(SaleService $saleService, $id): void
    {
        $saleService->delete($id);
        $this->search();
    }

    public function render(SaleService $saleService): View
    {
        $sales = null;
        if (auth()->user()->hasRole('employee')) {
            $sales = $saleService->search(auth()->user(), $this->selectedYear, $this->selectedQuarter);
        }
        if ($this->selectedUser) {
            $this->user = User::find($this->selectedUser);
            $sales = $saleService->search($this->user, $this->selectedYear, $this->selectedQuarter);
        }

        return view('livewire.employee.sale', [
            'sales' => $sales,
        ]);
    }
}

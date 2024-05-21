<?php
declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Calculator extends Component
{

    public $year;

    public $quarter;

    public $employee;

    public function edit($employee): void
    {
        $this->employee = $employee;
        $this->dispatch('bonus-edit', employee: $employee, year: $this->year, quarter: $this->quarter);
    }

    public function render(): View
    {
        if ($this->year == null && $this->quarter == null) {
            $now = Carbon::now();
            $this->year = $now->year;
            $this->quarter = $now->quarter;
        }
        if (Auth::user()->role('super-manager')) {
            $employees = User::role('employee')->orderBy('departament_id')->get();
        } else {
            $employees = User::role('employee')->where('departament_id', Auth::user()->departament_id)->get();
        }
        return view('livewire.pages.calculator', ['employees' => $employees, 'year' => $this->year, 'quarter' => $this->quarter]);
    }
}

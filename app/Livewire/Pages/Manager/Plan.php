<?php

namespace App\Livewire\Pages\Manager;

use App\Models\EmployeePoint;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Plan extends Component
{

    #[Validate('numeric|min:0|max:999999.99')]
    public $q1;
    #[Validate('numeric|min:0|max:999999.99')]
    public $q2;
    #[Validate('numeric|min:0|max:999999.99')]
    public $q3;
    #[Validate('numeric|min:0|max:999999.99')]
    public $q4;
    public $year;
    public $quarter;
    public bool $myModal2 = false;
    public $employeeId;

    public function mount()
    {
        $this->year = (new Carbon)->year;
        $this->quarter = (new Carbon)->quarter;
    }

    public function editPoints($id)
    {
        $this->resetValidation();
        $allocations = EmployeePoint::where('user_id' , $id)
        ->where('year' , $this->year)
        ->get();
        $this->employeeId = $id;
        foreach ($allocations as $allocation) {
            if ($allocation->quarter == 1) {
                $this->q1 = $allocation->points;
            }
            if ($allocation->quarter == 2) {
                $this->q2 = $allocation->points;
            }
            if ($allocation->quarter == 3) {
                $this->q3 = $allocation->points;
            }
            if ($allocation->quarter == 4) {
                $this->q4 = $allocation->points;
            }
        }
        $this->myModal2 = true;
    }
    public function update()
    {

        $this->validate();
        $allocations = EmployeePoint::where('user_id' , $this->employeeId)->where('year' , $this->year)->get();
        foreach ($allocations as $allocation) {
            if ($allocation->quarter == 1) {
                $allocation->update(['points' => $this->q1]);
            }
            if ($allocation->quarter == 2) {
                $allocation->update(['points' => $this->q2]);
            }
            if ($allocation->quarter == 3) {
                $allocation->update(['points' => $this->q3]);
            }
            if ($allocation->quarter == 4) {
                $allocation->update(['points' => $this->q4]);
            }
        }
        session()->flash('status', "Punkty pomyślnie zmienione");
        $this->myModal2 = false;
    }

    public function render()
    {
        $employees = User::role('employee')->where('departament_id', auth()->user()->departament_id)->get();

        $allocationValues = [];
        foreach ($employees as $key => $employee) {
             for ($quarter = 1; $quarter <= 4; $quarter++) {
                 $allocation = EmployeePoint::firstOrCreate(['user_id' => $employee->id, 'year' => $this->year, 'quarter' => $quarter]);
                 $allocationValues[$key]['employeeId'] = $employee->id;
                 $allocationValues[$key]['name'] = $employee->name ?? '';
                 $allocationValues[$key][$quarter] = $allocation->points ?? 0;
             }
        }
//        dd($allocationValues);
        return view('livewire.pages.manager.plan', ['employees' => $employees, 'allocations' => $allocationValues]);
    }
}

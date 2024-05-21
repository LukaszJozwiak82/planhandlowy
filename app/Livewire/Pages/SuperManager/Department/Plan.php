<?php

namespace App\Livewire\Pages\SuperManager\Department;

use App\Models\Departament;
use App\Models\DepartamentPoint;
use Carbon\Carbon;
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
    public bool $editModal = false;
    public $departmentId;

    public function mount()
    {
        $this->year = (new Carbon)->year;
        $this->quarter = (new Carbon)->quarter;
    }

    public function editPoints($id)
    {
        $this->resetValidation();
        $allocations = DepartamentPoint::where('departament_id' , $id)
            ->where('year' , $this->year)
            ->get();
        $this->departmentId = $id;
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
        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();
        DepartamentPoint::where('departament_id', $this->departmentId)
            ->where('year', $this->year)
            ->where('quarter', 1)
            ->update(['points' => $this->q1]);
        DepartamentPoint::where('departament_id', $this->departmentId)
            ->where('year', $this->year)
            ->where('quarter', 2)
            ->update(['points' => $this->q2]);
        DepartamentPoint::where('departament_id', $this->departmentId)
            ->where('year', $this->year)
            ->where('quarter', 3)
            ->update(['points' => $this->q3]);
        DepartamentPoint::where('departament_id', $this->departmentId)
            ->where('year', $this->year)
            ->where('quarter', 4)
            ->update(['points' => $this->q4]);
        session()->flash('success', "Punkty pomyślnie zmienione");
        $this->editModal = false;
    }

    public function render()
    {
        $departments = Departament::all();
        $allocationValues = [];
        foreach ($departments as $key => $department) {
            for ($quarter = 1; $quarter <= 4; $quarter++) {
                $allocation = DepartamentPoint::firstOrCreate(['departament_id' => $department->id, 'year' => $this->year, 'quarter' => $quarter]);
                $allocationValues[$key]['departamentId'] = $department->id;
                $allocationValues[$key]['name'] = $department->name ?? '';
                $allocationValues[$key][$quarter] = $allocation->points ?? 0;
            }
        }
        return view('livewire.pages.super-manager.department.plan', ['departments' => $departments, 'allocations' => $allocationValues]);
    }
}

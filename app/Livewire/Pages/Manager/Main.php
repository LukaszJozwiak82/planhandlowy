<?php

namespace App\Livewire\Pages\Manager;

use App\Models\Departament;
use App\Models\Loan;
use App\Models\LoanSale;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Main extends Component
{

public $departments;
public $year;
public $quarter;
public $quarterRealizationData = [];
public $employees = [];
public $loans;
public $allUsersData = [];
public $count = 0;
public $pointsForDepartament = [];
public $quartelySales = [];
public $quartelyPercentSales = [];


    public function mount()
    {
        $this->departments = Departament::where('name', 'not like','Centrala')->get();
        $this->quarter = ceil(date('m') / 3);
        $this->year = date('Y');
        $user_oddzial_id = Auth::user()->departament_id;
        $this->loans = Loan::where('status', 'active')->get();
        $this->employees = User::role('employee')
            ->orderBy('departament_id')
            ->get();
//            ->where('departament_id', $user_oddzial_id)->get();
        foreach ($this->employees as $employee) {
            $userData = [];

            foreach ($this->loans as $loan) {
                $count = LoanSale::whereIn('sale_id', Sale::select(['id'])
                    ->where('user_id', $employee->id)
                    ->where('year', $this->year)
                    ->where('quarter', $this->quarter)
                )
                    ->where('loan_id', $loan->id)
                    ->sum('value');
                $userData[$loan->id] = $count;
            }

            $userData['score'] = $employee->getScore($this->year, $this->quarter);
            $userData['name'] = $employee->name;
            $this->allUsersData[] = $userData;
        }


//        for ($i = 0; $i <= (count($this->loans) - 1); $i++) {
//            $sum = array_sum(array_column($this->allUsersData, $i));
//            $this->quarterRealizationData[$i] = $sum;
//        }
        foreach($this->departments as $department){

            $this->pointsForDepartament[$department->id] = $department->departamentPoints->where('year', $this->year)->where('quarter', $this->quarter)->first()->points ?? 0;
            $this->quartelySales[$department->id] = Sale::where('departament_id', $department->id)->where('year', $this->year)->where('quarter', $this->quarter)->sum('points');
            if($this->pointsForDepartament[$department->id] == 0){
                $this->quartelyPercentSales[$department->id] = 0;
            }else{
                $this->quartelyPercentSales[$department->id] = round(($this->quartelySales[$department->id] / $this->pointsForDepartament[$department->id]) * 100, 2);
            }
        }
    }

    public function render()
    {
        return view('livewire.pages.manager.main', [
            'departments' => $this->departments,
            'year' => $this->year,
            'quarter' => $this->quarter,
//            'quarterRealizationsData' => $this->quarterRealizationData,
            'employees' => $this->employees,
            'loans' => $this->loans,
            'allDataUsers' => $this->allUsersData,
            'quartelySales' => $this->quartelySales,
            'pointsForDepartament' => $this->pointsForDepartament,
            'quartelyPercentSales' => $this->quartelyPercentSales]);
    }
}

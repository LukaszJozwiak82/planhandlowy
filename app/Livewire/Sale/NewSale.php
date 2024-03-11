<?php

namespace App\Livewire\Sale;

use App\Models\Connection;
use App\Models\Deposit;
use App\Models\Insurance;
use App\Models\Loan;
use App\Models\Package;
use App\Models\User;
use Livewire\Component;

class NewSale extends Component
{
    public $users, $deposits, $loans, $insurances, $saleData = null,
        $recommended, $loan_id, $adviser, $modulo, $insurance_id, $contribution, $current_funding, $packages;
    public $connections;
    public bool $loan_granted = false;
    public bool $insuranceGranted = false;
    public bool $loanGranted = false;
    public bool $packageSold = false;
    public $depositValue;
    public array $connection = [];
    public array $deposit = [];
    public $package;
    public int $totalPoints = 0;
    public int $insuranceTotalSalePoints = 0;
    public float $loanTotalSalePoints = 0;
    public int $packageTotalSalePoints = 0;
    public $rrso;
    public int $loan_value;

    protected $listeners = [
        'moduloToParent' => 'getModulo'
    ];

    public function mount()
    {
        $this->loans = Loan::where('status', 'active')->get();
        $this->insurances = Insurance::select(['id', 'name'])->where('status', true)->get();
        $this->users = User::role('employee')->where('departament_id', Auth()->user()->departament_id)->get();
        $this->deposits = Deposit::where('status', true)->get();
        $this->connections = Connection::all();
        $this->packages = Package::where('status', true)->get();
    }

    public function render()
    {
        return view('livewire.sale.new-sale');
    }
}

<?php

namespace App\Livewire\Sale;

use App\Models\Client;
use App\Models\Connection;
use App\Models\ConnectionSale;
use App\Models\Deposit;
use App\Models\DepositValue;
use App\Models\Insurance;
use App\Models\InsuranceSale;
use App\Models\Loan;
use App\Models\LoanSale;
use App\Models\Package;
use App\Models\PackageSale;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


#[Layout('components.layouts.app')]
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
        $this->adviser = Auth()->user()->id;
    }

    protected $rules = [
        'saleData' => 'required',
        'loan_value' => 'numeric|nullable',
    ];

    protected $messages = [
        'saleData.required' => 'To pole jest wymagane.',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function getModulo($modulo)
    {
        $this->modulo = $modulo;
    }

    public function save() :Redirector
    {

        $validatedData = $this->validate();
        $convert_date = strtotime($this->saleData);
        $month = date('m', $convert_date);
        $year = date('Y', $convert_date);
        $day = date('d', $convert_date);
        $user_id = $this->adviser;
        $quarter = ceil($month / 3);

        //save client

        $client = Client::where('modulo', $this->modulo)->first();

        if (!$client) {
            $client = Client::create([
                'modulo' => $this->modulo,
            ]);
        }

        //new sale

        $sale = Sale::create([
            'user_id' => $user_id,
            'client_id' => $client->id,
            'actual_date' => $this->saleData,
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'quarter' => $quarter,
            'departament_id' => Auth::user()->departament_id,
        ]);


        //communication

        $formConnections = $this->connection;

        if ($formConnections != null) {
            $connections = Connection::all();
            foreach ($connections as $item) {
                $inArray = in_array($item->id, $formConnections) ?? false;
                if ($inArray) {
                    ConnectionSale::create([
                        'sale_id' => $sale->id,
                        'connection_id' => $item->id,
                        'points' => $item->points
                    ]);

                    $this->totalPoints = $this->totalPoints + (int)$item->points;
                }
            }
        }

        //sale deposits

        $formDeposits = $this->deposit;

        if ($formDeposits != null) {

            $deposits = Deposit::where('status', 1)->get();

            foreach ($deposits as $item) {
                $inArray = in_array($item->id, $formDeposits) ?? false;
                if ($inArray) {
                    DepositValue::create([
                        'sale_id' => $sale->id,
                        'deposit_id' => $item->id,
                        'is_sale' => true,
                    ]);
                    if ($item->is_value) {
                        $this->totalPoints = $this->totalPoints + (int)(0.05 / 100 * (int)$this->depositValue);
                    } else {
                        $this->totalPoints = $this->totalPoints + (int)$item->points;
                    }
                }
            }
        }

        //packages sale

        if ($this->packageSold){
            $packages = Package::where('status', true)->get();
            foreach ($packages as $package){
                if($package->id == $this->package){
                    $this->packageTotalSalePoints = intval($package->points);
                }
            }

            PackageSale::create([
                'package_id' => $this->package,
                'sale_id' => $sale->id,
                'points' => $this->packageTotalSalePoints,
            ]);
            $this->totalPoints = $this->totalPoints + intval($this->packageTotalSalePoints);
        }

        //insurance sale
        if ($this->insuranceGranted) {
            $insurances = Insurance::where('status', 1)->get();
            foreach ($insurances as $insurance) {
                $isSale = false;
                if ($insurance->id == $this->insurance_id) {
                    $isSale = true;
                    $this->insuranceTotalSalePoints = (int)($insurance->percent / 100) * $this->contribution;
                }
            }

            InsuranceSale::create([
                'sale_id' => $sale->id,
                'is_sale' => $isSale,
                'insurance_id' => $this->insurance_id,
                'contribution' => $this->contribution,
                'points' => $this->insuranceTotalSalePoints,
            ]);
            $this->totalPoints = $this->totalPoints + (int)$this->insuranceTotalSalePoints;
        }

        //loan sale

        if ($this->loanGranted) {
            $loans = Loan::where('status', 'active')->get();

            foreach ($loans as $loan) {
                $isSale = false;
                if ($loan->id == $this->loan_id) {
                    $isSale = true;
                    $this->loanTotalSalePoints = round((1 / $loan->percent) * $this->loan_value * (floatval(str_replace(',', '.',$this->rrso)) / 100));
                }
            }

            LoanSale::create([
                'sale_id' => $sale->id,
                'is_sale' => $isSale,
                'loan_id' => $this->loan_id,
                'value' => $this->loan_value,
                'current_funding' => $this->current_funding,
                'rrso' => floatval(str_replace(',', '.',$this->rrso)),
                'points' => $this->loanTotalSalePoints,
            ]);
            $this->totalPoints = $this->totalPoints + (int)$this->loanTotalSalePoints;
        }

        if($this->recommended == null)
        {
            //add points to sale
            $sale->points = $this->totalPoints;
            $sale->save();

            session()->flash('message', 'Gratulacje ' .Auth::user()->name.' ! Zdobyłaś(eś) '.$this->totalPoints. 'punktów');

            return redirect(route('employee.quarter', ['quarter' => $quarter, 'year' => $year]));
        }

        $saleRecommended = Sale::create([
            'user_id' => intval($this->recommended),
            'client_id' => $client->id,
            'actual_date' => $this->saleData,
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'quarter' => $quarter,
            'points' => round($this->totalPoints / 2),
            'recommended' => true,
            'sale_id' => $sale->id,
            'departament_id' => Auth::user()->departament_id,
        ]);

        //add points to sale
        $sale->points = round($this->totalPoints / 2);
        $sale->recommended = true;
        $sale->save();

        session()->flash('message', 'Gratulacje ' .Auth::user()->name.' ! Zdobyłaś(eś) '.round($this->totalPoints / 2). 'punktów');

        return redirect(route('employee.quarter', ['quarter' => $quarter, 'year' => $year]));
    }

    public function render()
    {
        return view('livewire.sale.new-sale');
    }
}

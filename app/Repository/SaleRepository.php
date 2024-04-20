<?php

namespace App\Repository;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

final class SaleRepository
{
    public function createSale(array $data): Sale
    {

        $date = Carbon::createFromDate($data['actual_date']);
        $month = $date->month;
        $day = $date->day;
        $year = $date->year;

        $sale = Sale::create([
            'user_id' => $data['user_id'],
            'client_id' => $data['client_id'],
            'actual_date' => $data['actual_date'],
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'quarter' => ceil($month / 3),
            'departament_id' => Auth::user()->departament_id,
        ]);

        return $sale;
    }
}

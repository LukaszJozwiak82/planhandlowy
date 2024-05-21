<?php

declare(strict_types=1);

namespace App\Services\Employee;

use App\Models\Sale;
use App\Models\User;

final class SaleService
{
    public function index(User $user)
    {
        return $user->sales->load('client');
    }

    public function search(User $user, $selectedYear, $selectedQuarter)
    {
        return $user->sales()
            ->where('year', $selectedYear)
            ->where('quarter', $selectedQuarter)
            ->paginate(10);
    }

    public function delete($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
    }
}

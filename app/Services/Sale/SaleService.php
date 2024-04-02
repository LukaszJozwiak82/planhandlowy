<?php

namespace App\Services\Sale;

use App\Models\Sale;
use App\Repository\SaleRepository;

final class SaleService
{
    private SaleRepository $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function createSale(array $data): Sale
    {
       return $this->saleRepository->createSale($data);
    }

}

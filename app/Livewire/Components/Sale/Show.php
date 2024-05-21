<?php

namespace App\Livewire\Components\Sale;

use App\Models\Sale;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{

    public bool $showModal = false;
    public $saleId;
    public $sale = null;

    #[On('show-modal')]
    public function showModal($saleId)
    {
        $this->saleId = $saleId;
        $this->showModal = true;
    }

    public function render()
    {
        $this->sale = Sale::find($this->saleId);
        return view('livewire.components.sale.show', ['sale' => $this->sale]);
    }
}

<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;

class Searchbox extends Component
{

    public $showdiv = false;
    public $search = "";
    public $records;
    public $empDetails;

    // Fetch records
    public function searchResult()
    {

        if (!empty($this->search)) {

            $this->records = Client::orderby('modulo', 'asc')
                ->select(['id', 'modulo'])
                ->where('modulo', 'like', '%' . $this->search . '%')
                ->limit(5)
                ->get();

            $this->showdiv = true;
            $this->emitUp('moduloToParent', $this->search);
        } else {
            $this->showdiv = false;
        }
    }

    // Fetch record by ID
    public function fetchEmployeeDetail($id = 0)
    {

        $record = Client::select('modulo')
            ->where('id', $id)
            ->first();

        $this->search = $record->modulo;
        $this->empDetails = $record;
        $this->showdiv = false;
        $this->emitUp('moduloToParent', $this->search);
    }
    public function render()
    {
        return view('livewire.client.searchbox');
    }
}

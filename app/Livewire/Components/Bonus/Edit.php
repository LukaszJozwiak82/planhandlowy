<?php

namespace App\Livewire\Components\Bonus;
use App\Models\ReferenceBonus;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $isOpen = false;
    public $employee;

    public $year;

    public $quarter;

    public $reference;

    public $individually;

    public $team;

    public $individualComponentPercent;

    public $teamComponentPercent;

    public ReferenceBonus $referenceBonus;


    #[On('bonus-edit')]
    public function openModal($employee, $year, $quarter)
    {
        $this->employee = $employee;
        $this->year = $year;
        $this->quarter = $quarter;
        $this->referenceBonus = ReferenceBonus::firstOrCreate(
            ['user_id' => $this->employee,
                'year' => $this->year,
                'quarter' => intval($this->quarter)],
            ['user_id' => $this->employee,
                'year' => $this->year,
                'quarter' => intval($this->quarter)]
        );

        $this->reference = $this->referenceBonus->reference ?? 0;
        $this->individually = $this->referenceBonus->individually ?? 0;
        $this->team = $this->referenceBonus->team ?? 0;
        $this->individualComponentPercent = $this->referenceBonus->individual_components_percent ?? 0;
        $this->teamComponentPercent = $this->referenceBonus->team_components_percent ?? 0;
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function update()
    {
        $this->referenceBonus->update([
            'reference' => $this->reference,
            'individually' => $this->individually,
            'team' => $this->team,
            'individual_components_percent' => $this->individualComponentPercent,
            'team_components_percent' => $this->teamComponentPercent,
        ]);

        session()->flash('message', 'Dane zmienione');

        return redirect()->route('calculator', ['year' => $this->year, 'quarter' => $this->quarter]);
    }

    public function render()
    {
        return view('livewire.components.bonus.edit');
    }
}

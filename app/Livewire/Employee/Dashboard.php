<?php

namespace App\Livewire\Employee;

use Livewire\Component;

class Dashboard extends Component
{
    public array $myChart = [
        'type' => 'pie',
        'data' => [
            'labels' => ['Mary', 'Joe', 'Ana'],
            'datasets' => [
                [
                    'label' => '# of Votes',
                    'data' => [12, 19, 3],
                ],
            ],
        ],
    ];

    public function render()
    {
        return view('livewire.employee.dashboard');
    }
}

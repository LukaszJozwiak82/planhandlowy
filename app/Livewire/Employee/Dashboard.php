<?php

namespace App\Livewire\Employee;

use Livewire\Component;

class Dashboard extends Component
{
    public array $myChartJanikowo = [];
    public array $myChartGniewkowo = [];
    public array $myChartTrzemeszno = [];

    public function mount()
    {
        $this->myChartJanikowo = [
            'type' => 'pie',
            'data' => [
                'labels' => ['Plan', 'Janikowo'],
                'datasets' => [
                    [
                        'label' => '# of Votes',
                        'data' => [12, 19],
                    ],
                ],
            ],
        ];
        $this->myChartGniewkowo = [
            'type' => 'pie',
            'data' => [
                'labels' => ['Plan', 'Gniewkowo'],
                'datasets' => [
                    [
                        'label' => '# of Votes',
                        'data' => [12, 19],
                    ],
                ],
            ],
        ];
        $this->myChartTrzemeszno = [
            'type' => 'pie',
            'data' => [
                'labels' => ['Plan', 'Trzemeszno'],
                'datasets' => [
                    [
                        'label' => '# of Votes',
                        'data' => [12, 19],
                    ],
                ],
            ],
        ];
    }

    public function render()
    {
        return view('livewire.employee.dashboard');
    }
}

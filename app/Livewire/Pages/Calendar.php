<?php
declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class Calendar extends Component
{
    public int $days;
    public $event;
    public $events;
    public int $month;
    public $year;
    public $eventsCount = [];

    public function createEvent($dateSelected): void
    {
        $this->dispatch('event-create', dateSelected: $dateSelected);
    }

    public function showEvent($id): void
    {
        $this->dispatch('event-show', id: $id);
    }

    public function mount(Event $event)
    {
        $this->event = $event;
        $today = date("d"); // Current day
        $this->month = intval(date("m")); // Current month
        $this->year = intval(date("Y")); // Current year
    }

    public function previousMonth($month, $year): void
    {
        $current = date('Y-m', strtotime($year . '-' . $month));
        $previousMonth = date('m', strtotime("-1 month", strtotime($current)));
        $previousYear = date('Y', strtotime("-1 month", strtotime($current)));
        $this->month = intval($previousMonth);
        $this->year = intval($previousYear);
        $this->render();
        // $this->year = $year;
    }

    public function nextMonth($month, $year): void
    {
        $current = date('Y-m', strtotime($year . '-' . $month));
        $nextMonth = date('m', strtotime("+1 month", strtotime($current)));
        $nextYear = date('Y', strtotime("+1 month", strtotime($current)));
        $this->month = intval($nextMonth);
        $this->year = intval($nextYear);
        $this->render();
        // $this->year = $year;
    }

    public function render(): View
    {
        $this->days = Carbon::createFromDate($this->year, $this->month)->daysInMonth;
        $this->events = Event::all();
        foreach (range(1, $this->days) as $number) {

            $count = $this->events->where('start', date('Y-m-d', strtotime($number . '-' . $this->month . '-' . $this->year)))->count();

            $this->eventsCount[$number] = $count;
        }
        
        return view('livewire.pages.calendar', [
            'days' => $this->days,
            'month' => $this->month,
            'events' => $this->events,
            'year' => $this->year,
            'eventsCount' => $this->eventsCount
        ]);
    }
}

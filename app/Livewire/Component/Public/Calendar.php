<?php

namespace App\Livewire\Component\Public;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Events;

class Calendar extends Component
{
    public $year;
    public $month;

    public $dates = [];
    public $events = [];

    public function mount() {
        $this->dates = $this->dates(Carbon::now());
    }

    public function dates($date) {
        $dates = [];

        $this->year = $date->year;

        $this->month = [
            'name' => $date->format('F'),
            'value' => $date->month
        ];

        $daysInMonth = $date->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dates[] = Carbon::create($this->year, $this->month['value'], $day);

            $date = $this->year . '-' . $this->month['value'] . '-' . $day;

            $event = Events::where(function ($events) use ($date) {
                $events->where('events_start_date', '<=', $date);
                $events->where('events_end_date', '>=', $date);
            })
            ->where('events_status', true)
            ->first();

            $this->events[date('Y-m-d', strtotime($date))] = $event ? $event->events_name : null;
        }

        return $dates;
    }

    public function togglePrevMonth() {
        $month = $this->month['value']--;

        if ($month == 0) {
            $this->month['value'] = 12;
            $this->year--;
        }

        $this->dates = $this->dates(Carbon::create($this->year, $this->month['value'], 1));
    }

    public function toggleNextMonth() {
        $month = $this->month['value']++;

        if ($month > 12) {
            $this->month['value'] = 1;
            $this->year++;
        }

        $this->dates = $this->dates(Carbon::create($this->year, $this->month['value'], 1));
    }

    public function render()
    {
        return view('livewire.component.public.calendar');
    }
}

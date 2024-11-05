<?php

namespace App\Livewire\Component\Public;

use Livewire\{Component, WithPagination};
use App\Models\Events;

class UpcomingEvents extends Component
{
    use WithPagination;

    public $take;
    public $exept;

    public function events()
    {
        return Events::where(function ($events) {
            $events->when($this->exept, function ($query, $exept) {
                $query->where('events_id', '!=', $exept);
            });

            $events->whereDate('events_start_date', '>', date('Y-m-d'));
        });
    }

    public function render()
    {
        return view('livewire.component.public.upcoming-events')->with([
            'data'=> $this->events()->orderBy('events_start_date')->paginate($this->take)
        ]);
    }
}
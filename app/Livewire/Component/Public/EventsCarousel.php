<?php

namespace App\Livewire\Component\Public;

use Livewire\{Component, WithPagination};
use App\Models\Events;

class EventsCarousel extends Component
{
    use WithPagination;

    public $paginate;
    public $exept;

    public function events()
    {
        return Events::where(function ($events) {
            $events->where('events_id', '!=', $this->exept);
            $events->whereDate('events_start_date', '>=', date('Y-m-d'));
        });
    }

    public function render()
    {
        return view('livewire.component.public.events-carousel')->with([
            'data' => $this->events()->paginate($this->paginate)
        ]);
    }
}

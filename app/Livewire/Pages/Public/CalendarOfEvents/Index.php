<?php

namespace App\Livewire\Pages\Public\CalendarOfEvents;

use Livewire\Component;
use App\Models\Events;

class Index extends Component
{
    public $event;

    public function mount()
    {
        $this->event = $this->event()->first();
    }

    public function event()
    {
        return Events::where(function ($events) {
            $events->whereDate('events_start_date', '>=', date('Y-m-d'));
            $events->whereNotNull('events_properties');
            $events->where('events_status', true);
        });
    }

    public function render()
    {
        return view('livewire.pages.public.calendar-of-events.index')->extends('layouts.public.app');
    }
}

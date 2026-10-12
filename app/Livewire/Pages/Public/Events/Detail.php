<?php

namespace App\Livewire\Pages\Public\Events;

use Livewire\{Component, WithPagination};
use App\Models\Events;

class Detail extends Component
{
    use WithPagination;

    public $tab = 'current';
    public $search;
    public $filter;
    public $event;

    public function mount($id, $slug)
    {
       $this->event = Events::find($id);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function events()
    {
        return Events::where(function ($events) {
            $events->when($this->search, function ($query, $search) {
                $query->where('events_name', 'LIKE', "%$search%");
            });

            $events->when($this->filter, function ($query, $filter) {
                $query->where('events_related_tags', 'LIKE', "%$filter%");
            });

            $events->when($this->tab, function ($query, $tab) {
                switch ($tab) {
                    case 'upcoming':
                        $query->whereDate('events_start_date', '>=', date('Y-m-d'));
                        $query->where('events_status', true);
                        break;

                    default:
                        $query->whereDate('events_start_date', '<', date('Y-m-d'));
                        $query->orWhere('events_status', false);
                        break;
                }
            });

            $events->where('events_id', '!=', $this->event->events_id);
        });
    }

    public function render()
    {
        return view('livewire.pages.public.events.detail')->extends('layouts.public.app')->with([
            'data' => $this->events()->orderBy('events_start_date')->paginate(3)
        ]);
    }
}

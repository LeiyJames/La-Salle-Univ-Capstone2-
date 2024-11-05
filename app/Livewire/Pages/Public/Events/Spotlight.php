<?php

namespace App\Livewire\Pages\Public\Events;

use Livewire\{Component, WithPagination};
use App\Models\Events;

class Spotlight extends Component
{
    use WithPagination;

    public $tab = 'current';
    public $activity_tab = 'basic_education';
    public $search;
    public $filter;
    public $event;
    public $activity;

    public function mount()
    {
        $this->event = $this->event()->first();
        $this->activity = $this->activity($this->event);
    }

    public function event()
    {
        return Events::where(function ($events) {
            $events->whereDate('events_start_date', '>=', date('Y-m-d'));
            $events->whereNotNull('events_properties');
            $events->where('events_status', true);
        });
    }

    public function activity($event)
    {
        $activities = $event->events_properties['spotlight']['activity'] ?? [];

        $data = [];

        foreach ($activities as $activity_key => $activity) {
            $data[$activity_key] = [];

            foreach ($activity as $key => $item) {
                $dateKey = date('Y-m-d', strtotime($item['date']));

                if (!isset($data[$activity_key][$dateKey])) {
                    $data[$activity_key][$dateKey] = [];
                }

                $data[$activity_key][$dateKey][] = $item;
            }
        }

        return $data;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function setActivityTab($tab)
    {
        $this->activity_tab = $tab;
    }

    public function events()
    {
        return Events::where(function ($events) {
            $events->when($this->search, function ($query, $search) {
                $query->where('events_name', 'LIKE', "%$search%");
            });

            $events->whereDate('events_start_date', '>=', date('Y-m-d'));

            $events->when($this->tab, function ($query, $tab) {
                switch ($tab) {
                    case 'academic_based':
                        $query->where('events_organization_type', $tab);
                        break;

                    case 'interest_based':
                        $query->where('events_organization_type', $tab);
                        break;
                }
            });

            $events->when($this->filter, function ($query, $filter) {
                $query->where('events_related_tags', 'LIKE', "%$filter%");
            });
        });
    }

    public function render()
    {
        return view('livewire.pages.public.events.spotlight')->extends('layouts.public.app')->with([
            'data' => $this->events()->orderBy('events_start_date')->paginate(3)
        ]);
    }
}

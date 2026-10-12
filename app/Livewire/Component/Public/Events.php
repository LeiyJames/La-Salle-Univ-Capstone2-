<?php

namespace App\Livewire\Component\Public;

use Livewire\{Component, WithPagination};
use App\Models\Events as EventsModel;

class Events extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = '';
    public $tab = 'upcoming';

    protected $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => ''],
        'tab' => ['except' => 'upcoming'],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilter()
    {
        $this->resetPage();
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
        $this->resetPage();
    }

    public function setFilter($filter)
    {
        $this->filter = ($this->filter === $filter) ? '' : $filter;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filter = '';
        $this->resetPage();
    }

    public function events()
    {
        return EventsModel::where(function ($events) {
            $events->when($this->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('events_name', 'LIKE', "%$search%")
                      ->orWhere('events_description', 'LIKE', "%$search%")
                      ->orWhere('events_location', 'LIKE', "%$search%");
                });
            });

            $events->when($this->filter, function ($query, $filter) {
                $query->where('events_related_tags', 'LIKE', "%$filter%");
            });

            $events->when($this->tab, function ($query, $tab) {
                if ($tab === 'upcoming') {
                    $query->whereDate('events_start_date', '>=', date('Y-m-d'))
                          ->where('events_status', true);
                } else {
                    $query->where(function ($q) {
                        $q->whereDate('events_start_date', '<', date('Y-m-d'))
                          ->orWhere('events_status', false);
                    });
                }
            });
        });
    }

    public function render()
    {
        $upcomingCount = EventsModel::whereDate('events_start_date', '>=', date('Y-m-d'))
            ->where('events_status', true)
            ->count();

        $archivedCount = EventsModel::where(function ($q) {
            $q->whereDate('events_start_date', '<', date('Y-m-d'))
              ->orWhere('events_status', false);
        })->count();

        $events = $this->events()
            ->orderBy($this->tab === 'upcoming' ? 'events_start_date' : 'events_start_date', $this->tab === 'upcoming' ? 'asc' : 'desc')
            ->paginate(6);

        return view('livewire.component.public.events', [
            'data' => $events,
            'upcomingCount' => $upcomingCount,
            'archivedCount' => $archivedCount,
        ]);
    }
}

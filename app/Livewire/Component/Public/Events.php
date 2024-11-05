<?php

namespace App\Livewire\Component\Public;

use Livewire\{Component, WithPagination};
use App\Models\Events as EventsModel;

class Events extends Component
{
    use WithPagination;

    public $search;
    public $filter;
    public $tab = 'upcoming';

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
        return EventsModel::where(function ($events) {
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
        });
    }

    public function render()
    {
        return view('livewire.component.public.events')->with([
            'data' => $this->events()->orderBy('events_start_date')->paginate(6)
        ]);
    }
}

<?php

namespace App\Livewire\Pages\Admin\Event;

use Livewire\{Component, WithPagination};
use App\Models\Events;
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $tab = 'all'; // all, upcoming, ongoing, past, draft
    public $organization = '';
    public $sortField = 'events_start_date';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $delete_event_modal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'tab' => ['except' => 'all'],
        'organization' => ['except' => ''],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedTab()
    {
        $this->resetPage();
    }

    public function updatedOrganization()
    {
        $this->resetPage();
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function resetFilters()
    {
        $this->reset(['search', 'organization', 'tab']);
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        $event = Events::findOrFail($id);
        $event->events_status = !$event->events_status;
        $event->save();
    }

    public function delete($id)
    {
        $this->delete_event_modal = true;
        $this->dispatch('delete-event', $id);
    }

    public function render()
    {
        $today = Carbon::today()->toDateString();

        // Counts for tab badges
        $counts = [
            'all' => Events::count(),
            'upcoming' => Events::where('events_status', true)->whereDate('events_start_date', '>', $today)->count(),
            'ongoing' => Events::where('events_status', true)->whereDate('events_start_date', '<=', $today)->whereDate('events_end_date', '>=', $today)->count(),
            'past' => Events::whereDate('events_end_date', '<', $today)->count(),
            'draft' => Events::where('events_status', false)->count(),
        ];

        // Organizations for filter dropdown
        $dbOrgs = Events::whereNotNull('events_organization_type')
            ->where('events_organization_type', '!=', '')
            ->distinct()
            ->pluck('events_organization_type')
            ->toArray();

        $defaultOrgs = ['CCSEA', 'CBA', 'CTE', 'CON', 'Basic Education', 'Higher Education', 'Sports', 'Campus Wide'];
        $organizations = array_values(array_unique(array_merge($dbOrgs, $defaultOrgs)));
        sort($organizations);

        // Build query
        $query = Events::query();

        // Search across multiple fields
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('events_name', 'LIKE', '%' . $this->search . '%')
                  ->orWhere('events_location', 'LIKE', '%' . $this->search . '%')
                  ->orWhere('events_description', 'LIKE', '%' . $this->search . '%')
                  ->orWhere('events_organization_type', 'LIKE', '%' . $this->search . '%');
            });
        }

        // Organization filter
        if (!empty($this->organization)) {
            $query->where('events_organization_type', $this->organization);
        }

        // Tab filter
        if ($this->tab === 'upcoming') {
            $query->where('events_status', true)->whereDate('events_start_date', '>', $today);
        } elseif ($this->tab === 'ongoing') {
            $query->where('events_status', true)->whereDate('events_start_date', '<=', $today)->whereDate('events_end_date', '>=', $today);
        } elseif ($this->tab === 'past') {
            $query->whereDate('events_end_date', '<', $today);
        } elseif ($this->tab === 'draft') {
            $query->where('events_status', false);
        }

        $events = $query->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.pages.admin.event.index', [
            'data' => $events,
            'counts' => $counts,
            'organizations' => $organizations,
        ])->extends('layouts.admin.app');
    }
}

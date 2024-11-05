<?php

namespace App\Livewire\Pages\Admin\Event;

use Livewire\{Component, WithPagination};
use App\Models\Events;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $delete_event_modal = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function events()
    {
        return Events::where(function ($events) {
            $events->when($this->search, function ($query, $search) {
                $query->where('events_name', 'LIKE', "%$search%");
            });
        });
    }

    public function delete($id)
    {
        $this->delete_event_modal = true;
        $this->dispatch('delete-event', $id);
    }

    public function render()
    {
        return view('livewire.pages.admin.event.index')->extends('layouts.admin.app')->with([
            'data' => $this->events()->paginate(10)
        ]);
    }
}

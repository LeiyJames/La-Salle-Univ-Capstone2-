<?php

namespace App\Livewire\Pages\Admin\Event;

use Livewire\{Component, WithFileUploads};
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Events;

class Create extends Component
{
    use WithFileUploads;

    public $event;
    public $file;
    public $event_preview_modal;

    #[Rule([
        'file' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
        'event.events_name' => ['required', 'unique:events,events_name'],
        'event.events_start_date' => ['required', 'date', 'after:yesterday'],
        'event.events_end_date' => ['required', 'date', 'after:yesterday'],
        'event.events_location' => ['required'],
        'event.events_description' => ['required'],
        'event.events_organization_type' => ['nullable'],
        'event.events_related_tags' => ['nullable'],
        'event.events_workshop_registration' => ['required', 'boolean'],
        'event.events_registration_link' => ['required_if:event.events_workshop_registration,true']
    ])]

    public function mount()
    {
        $this->resetComponents();
    }

    public function resetComponents()
    {
        $this->event = [
            'events_id' => 0,
            'events_name' => '',
            'events_start_date' => '',
            'events_end_date' => '',
            'events_location' => '',
            'events_description' => '',
            'events_organization_type' => '',
            'events_related_tags' => '',
            'events_workshop_registration' => false,
            'events_registration_link' => null,
        ];

        $this->file = null;
        $this->event_preview_modal = false;

        $this->resetErrorBag();
    }

    public function preview()
    {
        $this->event_preview_modal = true;
        $this->dispatch('event-preview', ['event' => $this->event]);
    }

    public function save()
    {
        $this->validate();

        try {
            $this->event['events_related_tags'] = empty($this->event['events_related_tags']) ? null : implode(', ', $this->event['events_related_tags']);

            // dd($this->event);

            DB::transaction(function () {
                $events = Events::create($this->event);

                $events->addMedia($this->file)->toMediaCollection('events');

                return redirect()->route('event');
            });
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.event.create')->extends('layouts.admin.app');
    }
}

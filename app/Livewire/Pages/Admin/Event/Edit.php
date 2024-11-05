<?php

namespace App\Livewire\Pages\Admin\Event;

use Livewire\{Component, WithFileUploads};
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Events;

class Edit extends Component
{
    use WithFileUploads;

    public $event_id;
    public $event;
    #[Rule('file|mimes:jpg,jpeg,png|max:5120')]
    public $file;
    public $event_preview_modal;

    public function mount($id)
    {
        $this->event_id = $id;

        $this->resetComponents();
    }

    public function resetComponents()
    {
        $event = Events::find($this->event_id);

        $this->event = [
            'events_id' => $event->events_id,
            'events_name' => $event->events_name,
            'events_start_date' => $event->events_start_date,
            'events_end_date' => $event->events_end_date,
            'events_location' => $event->events_location,
            'events_description' => $event->events_description,
            'events_organization_type' => $event->events_organization_type,
            'events_related_tags' => explode(', ', $event->events_related_tags),
            'events_workshop_registration' => $event->events_workshop_registration,
            'events_registration_link' => $event->events_registration_link,
            'events_status' => $event->events_status
        ];

        $this->file = null;
        $this->event_preview_modal = false;

        $this->resetErrorBag();
    }

    public function preview()
    {
        $this->event_preview_modal = true;
        $this->dispatch('event-preview', ['event' => $this->event, 'file' => $this->file?->temporaryUrl()]);
    }

    public function save()
    {
        $validated = $this->validate([
            'event_id' => ['required', 'exists:events,events_id'],
            'event.events_name' => ['required', 'unique:events,events_name,' . $this->event_id . ',events_id'],
            'event.events_start_date' => ['required', 'date'],
            'event.events_end_date' => ['required', 'date'],
            'event.events_location' => ['required'],
            'event.events_description' => ['required'],
            'event.events_organization_type' => ['nullable'],
            'event.events_related_tags' => ['nullable'],
            'event.events_workshop_registration' => ['required', 'boolean'],
            'event.events_registration_link' => ['required_if:event.events_workshop_registration,true'],
            'event.events_status' => ['required', 'boolean']
        ]);

        try {
            DB::transaction(function () {
                $event = Events::find($this->event_id);

                if ($this->file && $this->validateOnly('file')) {
                    $event->addMedia($this->file)->toMediaCollection('events');
                }

                if ($this->event['events_related_tags']) {
                    $this->event['events_related_tags'] = implode(', ', $this->event['events_related_tags']);
                }

                $event->update($this->event);

                return redirect()->route('event');
            });
        } catch (\Exception $e) {
            //throw $e;
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.event.edit')->extends('layouts.admin.app');
    }
}

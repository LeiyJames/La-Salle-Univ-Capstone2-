<?php

namespace App\Livewire\Pages\Admin\Event;

use Livewire\{Component, WithFileUploads};
use Illuminate\Support\Facades\DB;
use App\Models\Events;

class Create extends Component
{
    use WithFileUploads;

    public $event = [];
    public $file;
    public $event_preview_modal = false;

    public function rules()
    {
        return [
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'event.events_name' => ['required', 'string', 'max:255', 'unique:events,events_name'],
            'event.events_start_date' => ['required', 'date'],
            'event.events_end_date' => ['required', 'date', 'after_or_equal:event.events_start_date'],
            'event.events_location' => ['required', 'string', 'max:255'],
            'event.events_description' => ['required', 'string'],
            'event.events_organization_type' => ['nullable', 'string'],
            'event.events_related_tags' => ['nullable'],
            'event.events_workshop_registration' => ['required'],
            'event.events_registration_link' => ['nullable', 'required_if:event.events_workshop_registration,true,1'],
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Please upload an event poster/banner image.',
            'event.events_name.required' => 'The event name is required.',
            'event.events_name.unique' => 'An event with this name already exists.',
            'event.events_start_date.required' => 'The start date is required.',
            'event.events_end_date.required' => 'The end date is required.',
            'event.events_end_date.after_or_equal' => 'The end date must be on or after the start date.',
            'event.events_location.required' => 'The event location is required.',
            'event.events_description.required' => 'The event description is required.',
            'event.events_registration_link.required_if' => 'A registration link is required when workshop registration is enabled.',
        ];
    }

    public function mount()
    {
        $this->resetComponents();
    }

    public function resetComponents()
    {
        $this->event = [
            'events_name' => '',
            'events_start_date' => '',
            'events_end_date' => '',
            'events_location' => '',
            'events_description' => '',
            'events_organization_type' => '',
            'events_related_tags' => [],
            'events_workshop_registration' => 0,
            'events_registration_link' => null,
        ];

        $this->file = null;
        $this->event_preview_modal = false;

        $this->resetErrorBag();
    }

    public function preview()
    {
        $this->event_preview_modal = true;
        $this->dispatch('event-preview', [
            'event' => $this->event,
            'file' => $this->file && method_exists($this->file, 'temporaryUrl') ? $this->file->temporaryUrl() : null
        ]);
    }

    public function save()
    {
        $this->validate($this->rules(), $this->messages());

        try {
            $eventData = $this->event;
            unset($eventData['events_id']);
            $eventData['events_status'] = true;
            $eventData['events_workshop_registration'] = (bool) ($eventData['events_workshop_registration'] ?? false);

            if (!empty($eventData['events_related_tags']) && is_array($eventData['events_related_tags'])) {
                $eventData['events_related_tags'] = implode(', ', $eventData['events_related_tags']);
            } else {
                $eventData['events_related_tags'] = is_string($eventData['events_related_tags'] ?? null) ? $eventData['events_related_tags'] : '';
            }

            DB::transaction(function () use ($eventData) {
                $events = Events::create($eventData);

                if ($this->file) {
                    $events->addMedia($this->file)->toMediaCollection('events');
                }
            });

            session()->flash('success', 'Event successfully created and published!');
            return redirect()->route('event');
        } catch (\Throwable $e) {
            session()->flash('error', 'Error creating event: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.event.create')->extends('layouts.admin.app');
    }
}

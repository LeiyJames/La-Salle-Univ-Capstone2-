<?php

namespace App\Livewire\Pages\Admin\Event;

use Livewire\{Component, WithFileUploads};
use Illuminate\Support\Facades\DB;
use App\Models\Events;
use Carbon\Carbon;

class Edit extends Component
{
    use WithFileUploads;

    public $event_id;
    public $event;
    public $file;
    public $event_preview_modal;

    public function rules(): array
    {
        return [
            'event_id' => ['required', 'exists:events,events_id'],
            'event.events_name' => ['required', 'string', 'max:255', 'unique:events,events_name,' . $this->event_id . ',events_id'],
            'event.events_start_date' => ['required', 'date'],
            'event.events_end_date' => ['required', 'date', 'after_or_equal:event.events_start_date'],
            'event.events_location' => ['required', 'string', 'max:255'],
            'event.events_description' => ['required', 'string'],
            'event.events_organization_type' => ['nullable'],
            'event.events_related_tags' => ['nullable'],
            'event.events_workshop_registration' => ['required', 'boolean'],
            'event.events_registration_link' => ['nullable', 'required_if:event.events_workshop_registration,true'],
            'event.events_status' => ['required', 'boolean'],
            'file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'event.events_name.required' => 'The event title is required.',
            'event.events_name.unique' => 'An event with this title already exists.',
            'event.events_start_date.required' => 'Please provide an event start date.',
            'event.events_end_date.required' => 'Please provide an event end date.',
            'event.events_end_date.after_or_equal' => 'The end date cannot be earlier than the start date.',
            'event.events_location.required' => 'Please specify the event location.',
            'event.events_description.required' => 'Please enter an event description.',
            'event.events_registration_link.required_if' => 'A registration link is required when workshop registration is enabled.',
            'file.image' => 'The uploaded file must be an image.',
            'file.mimes' => 'Event poster must be a JPG, PNG, or WEBP image.',
            'file.max' => 'The event poster image must not exceed 10MB.',
        ];
    }

    public function mount($id)
    {
        $this->event_id = $id;

        $this->resetComponents();
    }

    public function resetComponents()
    {
        $event = Events::findOrFail($this->event_id);

        $tags = [];
        if (!empty($event->events_related_tags)) {
            $tags = array_values(array_filter(array_map('trim', explode(',', $event->events_related_tags))));
        }

        $this->event = [
            'events_id' => $event->events_id,
            'events_name' => $event->events_name,
            'events_start_date' => $event->events_start_date ? Carbon::parse($event->events_start_date)->format('Y-m-d') : '',
            'events_end_date' => $event->events_end_date ? Carbon::parse($event->events_end_date)->format('Y-m-d') : '',
            'events_location' => $event->events_location,
            'events_description' => $event->events_description,
            'events_organization_type' => $event->events_organization_type ?? '',
            'events_related_tags' => $tags,
            'events_workshop_registration' => (bool) $event->events_workshop_registration,
            'events_registration_link' => $event->events_registration_link,
            'events_status' => (bool) $event->events_status
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
            DB::transaction(function () {
                $event = Events::findOrFail($this->event_id);

                if ($this->file) {
                    $event->addMedia($this->file)->toMediaCollection('events');
                }

                $eventData = $this->event;
                unset($eventData['events_id']);

                if (!empty($eventData['events_related_tags']) && is_array($eventData['events_related_tags'])) {
                    $eventData['events_related_tags'] = implode(', ', array_filter($eventData['events_related_tags']));
                } else {
                    $eventData['events_related_tags'] = is_string($eventData['events_related_tags'] ?? null) ? $eventData['events_related_tags'] : '';
                }

                $event->update($eventData);
            });

            session()->flash('success', 'Event updated successfully!');
            return redirect()->route('event');
        } catch (\Throwable $e) {
            session()->flash('error', 'Error updating event: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.event.edit')->extends('layouts.admin.app');
    }
}

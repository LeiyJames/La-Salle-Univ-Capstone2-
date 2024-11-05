<?php

namespace App\Livewire\Pages\Admin\Event;

use Livewire\{Component, WithFileUploads};
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Events;

class Spotlight extends Component
{
    use WithFileUploads;

    public $tab;
    public $spotlight;
    public $activity;
    public $file;
    public $events;
    public $customError;

    #[Rule([
        'file' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
        'spotlight.event_id' => ['required', 'exists:events,events_id'],
        'spotlight.description' => ['required']
    ])]

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function mount()
    {
        $this->resetComponents();
    }

    public function save()
    {
        $this->customValidate();

        if (!$this->customError) {
            try {
                DB::transaction(function () {
                    $event = Events::find($this->spotlight['event_id']);

                    $event->update([
                        'events_properties' => [
                            'spotlight' => [
                                'description' => $this->spotlight['description'],
                                'activity' => $this->activity
                            ]
                        ]
                    ]);

                    return redirect()->route('event');
                });
            } catch (\Exception $e) {
                //throw $e;
                dd($e);
            }
        }
    }

    public function customValidate()
    {
        $this->validate();

        foreach ($this->activity as $type => $value) {

            foreach ($value as $key => $item) {

                if ($item['date'] < $this->spotlight['start_date']) {
                    $this->customError[$key] = [
                        'key' => 'date',
                        'message' => 'Date must be greater than or equal to start date'
                    ];
                }
            }
        }
    }

    public function resetComponents()
    {
        $this->spotlight = [
            'event_id' => null,
            'start_date' => '',
            'end_date' => '',
            'description' => ''
        ];

        $this->activity = [
            'basic_education' => [
                [
                    'name' => null,
                    'location' => null,
                    'date' => null
                ]
            ],
            'higher_education' => [
                [
                    'name' => null,
                    'location' => null,
                    'date' => null
                ]
            ]
        ];

        $this->file = null;
        $this->tab = 'basic_education';
        $this->events = $this->events()->get();

        $this->resetErrorBag();
    }

    public function addActivity()
    {
        $this->activity[$this->tab][] = [
            'name' => null,
            'location' => null,
            'date' => null
        ];
    }

    public function removeActivity($index)
    {
        unset($this->activity[$this->tab][$index]);
    }

    public function updatedSpotlightEventId($value)
    {
        $event = Events::find($value);

        if ($event) {
            $this->spotlight['start_date'] = $event->events_start_date;
            $this->spotlight['end_date'] = $event->events_end_date;
            $this->spotlight['description'] = $event->events_properties['spotlight']['description'] ?? '';
            $this->activity = $event->events_properties['spotlight']['activity'] ?? [];
        }
    }

    public function events()
    {
        return Events::where(function ($events) {
            $events->where('events_status', true);
        });
    }

    public function render()
    {
        return view('livewire.pages.admin.event.spotlight')->extends('layouts.admin.app');
    }
}

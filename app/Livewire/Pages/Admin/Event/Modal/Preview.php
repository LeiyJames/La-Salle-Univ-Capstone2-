<?php

namespace App\Livewire\Pages\Admin\Event\Modal;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Events;

class Preview extends Component
{
    public $modal;
    public $event;
    public $file;

    #[On('event-preview')]
    public function data($data)
    {
        $this->event = $data['event'];

        if (isset($data['file'])) {
            $this->file = $data['file'];
        }
        else {
            if (is_object($this->file)) {
                $this->file = $this->file->temporaryUrl();
            }
            else {
                $event = Events::find($data['event']['events_id']);
                $this->file = $event->getFirstMedia('events') ? $event->getFirstMedia('events')->getFullUrl() : null;
            }
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.event.modal.preview');
    }
}

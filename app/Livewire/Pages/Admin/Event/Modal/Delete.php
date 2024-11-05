<?php

namespace App\Livewire\Pages\Admin\Event\Modal;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Events;

class Delete extends Component
{
    public $modal;
    public $event;

    #[On('delete-event')] 
    public function data(Events $event)
    {
        $this->event = $event;
    }

    public function submit() 
    {
        $this->event->delete();
        return redirect()->route('event');
    }

    public function render()
    {
        return view('livewire.pages.admin.event.modal.delete');
    }
}

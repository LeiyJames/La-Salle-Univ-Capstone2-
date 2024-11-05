<?php

namespace App\Livewire\Layout\Admin;

use Livewire\Component;

class Header extends Component
{   
    public $fullname;

    public function mount()
    {
        $this->fullname = auth()->user()->fullName();
    }

    public function render()
    {
        return view('livewire.layout.admin.header');
    }
}

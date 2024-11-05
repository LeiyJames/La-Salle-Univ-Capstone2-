<?php

namespace App\Livewire\Pages\Admin\Home;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.home.index')->extends('layouts.admin.app');
    }
}

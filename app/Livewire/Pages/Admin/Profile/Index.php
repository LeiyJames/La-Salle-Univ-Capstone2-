<?php

namespace App\Livewire\Pages\Admin\Profile;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.profile.index')->extends('layouts.admin.app');
    }
}

<?php

namespace App\Livewire\Pages\Public\About;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.public.about.index')->extends('layouts.public.app');
    }
}

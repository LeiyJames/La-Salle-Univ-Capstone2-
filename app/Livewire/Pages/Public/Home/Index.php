<?php

namespace App\Livewire\Pages\Public\Home;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.public.home.index')->extends('layouts.public.app');
    }
}

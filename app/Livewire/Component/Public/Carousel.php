<?php

namespace App\Livewire\Component\Public;

use Livewire\Component;
use App\Models\Gallery;

class Carousel extends Component
{
    public $height = '500';

    public function render()
    {
        $galleries = Gallery::where('galleries_type', 'carousel')
            ->where('galleries_status', true)
            ->latest()
            ->get();

        return view('livewire.component.public.carousel', [
            'galleries' => $galleries,
        ]);
    }
}

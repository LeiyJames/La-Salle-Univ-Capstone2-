<?php

namespace App\Livewire\Component\Public;

use Livewire\{Component, WithPagination};
use App\Models\Gallery;

class Carousel extends Component
{
    use WithPagination;

    public $height = '500';

    public function galleries()
    {
        return Gallery::where(function ($gallery) {
            $gallery->where('galleries_type', 'carousel');
            $gallery->where('galleries_status', true);
        });
    }

    public function render()
    {
        return view('livewire.component.public.carousel')->with([
            'data' => $this->galleries()->paginate(1)
        ]);
    }
}

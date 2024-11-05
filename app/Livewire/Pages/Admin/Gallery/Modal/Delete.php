<?php

namespace App\Livewire\Pages\Admin\Gallery\Modal;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Gallery;

class Delete extends Component
{
    public $modal;
    public $gallery;

    #[On('delete-gallery')] 
    public function data(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function submit() 
    {
        $this->gallery->delete();
        return redirect()->route('admin.gallery');
    }

    public function render()
    {
        return view('livewire.pages.admin.gallery.modal.delete');
    }
}

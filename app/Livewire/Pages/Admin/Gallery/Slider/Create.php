<?php

namespace App\Livewire\Pages\Admin\Gallery\Slider;

use Livewire\{Component, WithFileUploads};
use Livewire\Attributes\Rule;
use App\Models\Gallery;

class Create extends Component
{
    use WithFileUploads;

    public $slider;

    #[Rule('required|file|mimes:jpg,jpeg,png|max:5120')]
    public $file;

    #[Rule('required')]
    public $type = 'carousel';

    public function save() {
        if ($this->validate()) {
            $gallery = Gallery::create([
                'galleries_type' => $this->type
            ]);

            $gallery->addMedia($this->file)->toMediaCollection('gallery');

            return redirect()->route('admin.gallery');
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.gallery.slider.create');
    }
}

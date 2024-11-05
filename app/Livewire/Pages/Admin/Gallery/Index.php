<?php

namespace App\Livewire\Pages\Admin\Gallery;

use Livewire\{Component, WithPagination};
use App\Models\Gallery;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $status;
    public $edit_gallery_slider = false;
    public $delete_gallery_modal = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function galleries()
    {
        return Gallery::where(function ($gallery) {
            $gallery->when($this->status, function ($query, $status) {
                $query->where('galleries_status', $status);
            });
        });
    }

    public function delete($id)
    {
        $this->delete_gallery_modal = true;
        $this->dispatch('delete-gallery', $id);
    }

    public function render()
    {
        return view('livewire.pages.admin.gallery.index')->extends('layouts.admin.app')->with([
            'data' => $this->galleries()->paginate(10)
        ]);
    }
}

<?php

namespace App\Livewire\Pages\Admin\Gallery;

use Livewire\{Component, WithPagination};
use App\Models\Gallery;

class Index extends Component
{
    use WithPagination;

    public $tab = 'all'; // all, active, inactive
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $delete_gallery_modal = false;

    protected $queryString = [
        'tab' => ['except' => 'all'],
    ];

    public function updatedTab()
    {
        $this->resetPage();
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function toggleStatus($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->galleries_status = !$gallery->galleries_status;
        $gallery->save();
    }

    public function delete($id)
    {
        $this->delete_gallery_modal = true;
        $this->dispatch('delete-gallery', $id);
    }

    public function render()
    {
        $counts = [
            'all' => Gallery::count(),
            'active' => Gallery::where('galleries_status', true)->count(),
            'inactive' => Gallery::where('galleries_status', false)->count(),
        ];

        $query = Gallery::query();

        if ($this->tab === 'active') {
            $query->where('galleries_status', true);
        } elseif ($this->tab === 'inactive') {
            $query->where('galleries_status', false);
        }

        $galleries = $query->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.pages.admin.gallery.index', [
            'data' => $galleries,
            'counts' => $counts,
        ])->extends('layouts.admin.app');
    }
}

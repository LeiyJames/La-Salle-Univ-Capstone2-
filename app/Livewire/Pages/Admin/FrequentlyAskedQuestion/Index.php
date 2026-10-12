<?php

namespace App\Livewire\Pages\Admin\FrequentlyAskedQuestion;

use Livewire\{Component, WithPagination};
use App\Models\FAQ;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $tab = 'all'; // all, active, inactive
    public $perPage = 10;
    public $edit_faq_slider = false;
    public $delete_faq_modal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'tab' => ['except' => 'all'],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedTab()
    {
        $this->resetPage();
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->faqs_status = !$faq->faqs_status;
        $faq->save();
    }

    public function edit($id)
    {
        $this->edit_faq_slider = true;
        $this->dispatch('edit-faq', $id);
    }

    public function delete($id)
    {
        $this->delete_faq_modal = true;
        $this->dispatch('delete-faq', $id);
    }

    public function render()
    {
        $counts = [
            'all' => FAQ::count(),
            'active' => FAQ::where('faqs_status', true)->count(),
            'inactive' => FAQ::where('faqs_status', false)->count(),
        ];

        $query = FAQ::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('faqs_question', 'LIKE', '%' . $this->search . '%')
                  ->orWhere('faqs_answer', 'LIKE', '%' . $this->search . '%');
            });
        }

        if ($this->tab === 'active') {
            $query->where('faqs_status', true);
        } elseif ($this->tab === 'inactive') {
            $query->where('faqs_status', false);
        }

        $faqs = $query->latest('created_at')->paginate($this->perPage);

        return view('livewire.pages.admin.frequently-asked-question.index', [
            'data' => $faqs,
            'counts' => $counts,
        ])->extends('layouts.admin.app');
    }
}

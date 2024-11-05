<?php

namespace App\Livewire\Pages\Admin\FrequentlyAskedQuestion;

use Livewire\{Component, WithPagination};
use App\Models\FAQ;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $status;
    public $edit_faq_slider = false;
    public $delete_faq_modal = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatus($value)
    {
        $this->status = $value == 1 ? 1 : 0;
    }

    public function faqs()
    {
        return FAQ::where(function ($faq) {
            $faq->when($this->search, function ($query, $search) {
                $query->where('faqs_question', 'LIKE', "%$search%");
                $query->orWhere('faqs_answer', 'LIKE', "%$search%");
            });

            $faq->when(is_numeric($this->status), function ($query, $status) {
                $query->where('faqs_status', $this->status);
            });
        });
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
        return view('livewire.pages.admin.frequently-asked-question.index')->extends('layouts.admin.app')->with([
            'data' => $this->faqs()->paginate(10)
        ]);
    }
}

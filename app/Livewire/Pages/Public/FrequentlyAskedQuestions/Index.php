<?php

namespace App\Livewire\Pages\Public\FrequentlyAskedQuestions;

use Livewire\{Component, WithPagination};
use App\Models\FAQ;

class Index extends Component
{
    use WithPagination;

    public $search;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function faqs()
    {
        return FAQ::where(function ($faq) {
            $faq->when($this->search, function ($query, $search) {
                $query->where('faqs_question', 'LIKE', "%$search%");
                $query->orWhere('faqs_answer', 'LIKE', "%$search%");
            });

            $faq->where('faqs_status', true);
        });
    }

    public function render()
    {
        return view('livewire.pages.public.frequently-asked-questions.index')->extends('layouts.public.app')->with([
            'data' => $this->faqs()->paginate(10)
        ]);
    }
}

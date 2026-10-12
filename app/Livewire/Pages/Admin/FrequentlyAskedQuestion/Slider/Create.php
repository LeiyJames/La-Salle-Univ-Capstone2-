<?php

namespace App\Livewire\Pages\Admin\FrequentlyAskedQuestion\Slider;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\FAQ;

class Create extends Component
{
    public $slider;
    public $faq;

    protected $rules = [
        'faq.faqs_question' => 'required|string|min:3',
        'faq.faqs_answer' => 'required|string|min:3',
        'faq.faqs_status' => 'required',
    ];

    public function mount()
    {
        $this->resetComponents();
    }

    public function resetComponents()
    {
        $this->faq = [
            'faqs_question' => '',
            'faqs_answer' => '',
            'faqs_status' => true
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                FAQ::create($this->faq);
            });

            return redirect()->route('admin.frequently-asked-question');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.frequently-asked-question.slider.create');
    }
}

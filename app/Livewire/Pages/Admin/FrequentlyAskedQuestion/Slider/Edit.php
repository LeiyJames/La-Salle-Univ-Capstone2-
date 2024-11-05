<?php

namespace App\Livewire\Pages\Admin\FrequentlyAskedQuestion\Slider;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\FAQ;

class Edit extends Component
{
    public $slider;
    public $faq_id;
    public $faq;

    #[On('edit-faq')]
    public function data(FAQ $faq)
    {
        $this->faq_id = $faq->faqs_id;

        $this->faq = [
            'faqs_question' => $faq->faqs_question,
            'faqs_answer' => $faq->faqs_answer,
            'faqs_status' => $faq->faqs_status
        ];
    }

    public function save()
    {
        try {
            DB::transaction(function () {
                $faq = FAQ::find($this->faq_id);

                $faq->update($this->faq);

                return redirect()->route('admin.frequently-asked-question');
            });
        } catch (\Exception $e) {
            //throw $e;
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.frequently-asked-question.slider.edit');
    }
}

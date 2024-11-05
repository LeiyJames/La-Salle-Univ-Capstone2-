<?php

namespace App\Livewire\Pages\Admin\FrequentlyAskedQuestion\Modal;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\FAQ;

class Delete extends Component
{
    public $modal;
    public $faq;

    #[On('delete-faq')] 
    public function data(FAQ $faq)
    {
        $this->faq = $faq;
    }

    public function submit() 
    {
        $this->faq->delete();
        return redirect()->route('admin.frequently-asked-question');
    }

    public function render()
    {
        return view('livewire.pages.admin.frequently-asked-question.modal.delete');
    }
}

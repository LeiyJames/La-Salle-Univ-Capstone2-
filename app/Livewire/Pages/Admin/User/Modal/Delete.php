<?php

namespace App\Livewire\Pages\Admin\User\Modal;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\User;

class Delete extends Component
{
    public $modal;
    public $user;

    #[On('delete-user')] 
    public function data(User $user)
    {
        $this->user = $user;
    }

    public function submit() 
    {
        $this->user->delete();
        return redirect()->route('admin.user');
    }

    public function render()
    {
        return view('livewire.pages.admin.user.modal.delete');
    }
}

<?php

namespace App\Livewire\Layout\Admin;

use Livewire\Component;
use App\Livewire\Actions\Logout;

class Sidebar extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.layout.admin.sidebar');
    }
}

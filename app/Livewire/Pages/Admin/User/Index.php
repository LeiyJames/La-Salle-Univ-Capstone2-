<?php

namespace App\Livewire\Pages\Admin\User;

use Livewire\{Component, WithPagination};
use App\Models\User;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $status;
    public $edit_user_slider = false;
    public $delete_user_modal = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function users()
    {
        return User::where(function ($users) {
            $users->when($this->search, function ($query, $search) {
                $query->where('users_family_name', 'LIKE', "%$search%");
                $query->orWhere('users_given_name', 'LIKE', "%$search%");
                $query->orWhere('users_middle_name', 'LIKE', "%$search%");
                $query->orWhere('email', 'LIKE', "%$search%");
            });

            $users->when($this->status, function ($query, $status) {
                $query->where('users_status', $status);
            });
        });
    }

    public function edit($id)
    {
        $this->edit_user_slider = true;
        $this->dispatch('edit-user', $id);
    }

    public function delete($id)
    {
        $this->delete_user_modal = true;
        $this->dispatch('delete-user', $id);
    }

    public function render()
    {
        return view('livewire.pages.admin.user.index')->extends('layouts.admin.app')->with([
            'data' => $this->users()->paginate(10)
        ]);
    }
}

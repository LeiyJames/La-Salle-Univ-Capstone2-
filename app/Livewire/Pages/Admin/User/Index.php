<?php

namespace App\Livewire\Pages\Admin\User;

use Livewire\{Component, WithPagination};
use App\Models\User;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $role = '';
    public $tab = 'all'; // all, admin, editor, student
    public $status = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;

    public $edit_user_slider = false;
    public $delete_user_modal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'tab' => ['except' => 'all'],
        'role' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedTab()
    {
        $this->resetPage();
    }

    public function updatedRole()
    {
        $this->resetPage();
    }

    public function updatedStatus()
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

    public function resetFilters()
    {
        $this->reset(['search', 'role', 'status', 'tab']);
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        if ($id === auth()->id()) {
            return;
        }

        $user = User::findOrFail($id);
        $user->users_status = !$user->users_status;
        $user->save();
    }

    public function edit($id)
    {
        $this->edit_user_slider = true;
        $this->dispatch('edit-user', $id);
    }

    public function delete($id)
    {
        if ($id === auth()->id()) {
            return;
        }

        $this->delete_user_modal = true;
        $this->dispatch('delete-user', $id);
    }

    public function render()
    {
        // Live counts for tabs
        $counts = [
            'all' => User::count(),
            'admin' => User::where('users_role', 'admin')->count(),
            'editor' => User::where('users_role', 'editor')->count(),
            'student' => User::where('users_role', 'student')->count(),
        ];

        $query = User::query();

        // Multi-field search
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('users_family_name', 'LIKE', "%{$this->search}%")
                  ->orWhere('users_given_name', 'LIKE', "%{$this->search}%")
                  ->orWhere('users_middle_name', 'LIKE', "%{$this->search}%")
                  ->orWhere('email', 'LIKE', "%{$this->search}%")
                  ->orWhere('users_organization_name', 'LIKE', "%{$this->search}%");
            });
        }

        // Tab filter (role-based)
        if ($this->tab === 'admin') {
            $query->where('users_role', 'admin');
        } elseif ($this->tab === 'editor') {
            $query->where('users_role', 'editor');
        } elseif ($this->tab === 'student') {
            $query->where('users_role', 'student');
        } elseif (!empty($this->role)) {
            $query->where('users_role', $this->role);
        }

        // Status filter
        if ($this->status !== '') {
            $query->where('users_status', (int) $this->status);
        }

        $users = $query->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.pages.admin.user.index', [
            'data' => $users,
            'counts' => $counts,
        ])->extends('layouts.admin.app');
    }
}

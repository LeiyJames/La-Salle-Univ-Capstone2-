<?php

namespace App\Livewire\Pages\Admin\User\Slider;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\{DB, Hash};
use App\Models\User;

class Create extends Component
{
    public $slider;
    public $user;

    #[Rule([
        'user.users_family_name' => ['required'],
        'user.users_given_name' => ['required'],
        'user.users_organization_name' => ['nullable'],
        'user.users_email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@lsu\.edu\.ph$/i'],
        'user.users_password' => ['required', 'min:6', 'max:50'],
        'user.users_role' => ['required', 'in:student,editor']
    ])]

    public function mount()
    {
        $this->resetComponents();
    }

    public function resetComponents()
    {
        $this->user = [
            'users_family_name' => null,
            'users_given_name' => null,
            'users_organization_name' => null,
            'users_email' => null,
            'users_password' => null,
            'users_role' => 'editor'
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                User::create([
                    'users_family_name' => $this->user['users_family_name'],
                    'users_given_name' => $this->user['users_given_name'],
                    'users_organization_name' => $this->user['users_organization_name'],
                    'email' => $this->user['users_email'],
                    'password' => Hash::make($this->user['users_password']),
                    'users_role' => $this->user['users_role'],
                ]);

                return redirect()->route('admin.user');
            });
        } catch (\Exception $e) {
            //throw $e;
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.user.slider.create');
    }
}

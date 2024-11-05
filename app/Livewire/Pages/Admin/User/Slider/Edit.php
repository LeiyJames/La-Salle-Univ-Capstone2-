<?php

namespace App\Livewire\Pages\Admin\User\Slider;

use Livewire\Component;
use Livewire\Attributes\{On, Rule};
use Illuminate\Support\Facades\{DB, Hash};
use App\Models\User;

class Edit extends Component
{
    #[Rule([
        'user.users_family_name' => ['required'],
        'user.users_given_name' => ['required'],
        'user.users_organization_name' => ['nullable'],
        'user.users_email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@lsu\.edu\.ph$/i'],
        'user.users_password' => ['nullable'],
        'user.users_role' => ['required', 'in:student,editor']
    ])]

    public $slider;
    public $user_id;
    public $user;

    #[On('edit-user')]
    public function data(User $user)
    {
        $this->user_id = $user->users_id;

        $this->user = [
            'users_family_name' => $user->users_family_name,
            'users_given_name' => $user->users_given_name,
            'users_organization_name' => $user->users_organization_name,
            'users_email' => $user->email,
            'users_password' => null,
            'users_role' => $user->users_role
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $user = User::find($this->user_id);

                $data = [
                    'users_family_name' => $this->user['users_family_name'],
                    'users_given_name' => $this->user['users_given_name'],
                    'users_organization_name' => $this->user['users_organization_name'],
                    'email' => $this->user['users_email'],
                    'users_role' => $this->user['users_role']
                ];

                if ($this->user['users_password']) {
                    $data = array_merge($data, [
                        'password' => Hash::make($this->user['password'])
                    ]);
                }

                $user->update($data);

                return redirect()->route('admin.user');
            });
        } catch (\Exception $e) {
            //throw $e;
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.user.slider.edit');
    }
}

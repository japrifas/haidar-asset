<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AdminProfileDetail extends Component
{
    public $users;
    public $name, $username, $email;

    public function mount()
    {
        $this->users = User::find(auth('web')->id());
        $this->name = $this->users->name;
        $this->username = $this->users->username;
        $this->email = $this->users->email;
    }

    public function UpdateProfileDetails()
    {
        $this->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users,username,'.auth('web')->id()
        ]);

        User::where('id', auth('web')->id())->update([
            'name' => $this->name,
            'username' => $this->username,
        ]);

        $this->emit('UpdateAdminProfileHeader');
        $this->emit('UpdateTopHeader');

        $this->showToastr('Your Profile info have been successfully updated.','info');
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr',[
            'type' => $type,
            'message' => $message
        ]);
    }

    public function render()
    {
        return view('livewire.admin-profile-detail');
    }
}

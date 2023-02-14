<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AdminProfileHeader extends Component
{
    public $user;

    protected $listeners = [
        'UpdateAdminProfileHeader'=>'$refresh'
    ];

    public function mount()
    {
        $this->user = User::find(auth('web')->id());
    }

    public function render()
    {
        return view('livewire.admin-profile-header');
    }
}

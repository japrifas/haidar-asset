<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TopHeader extends Component
{

    public $user;

    protected $listeners = [
        'UpdateTopHeader'=>'$refresh'
    ];

    public function mount()
    {
        $this->user = User::find(auth('web')->id());
    }

    public function render()
    {
        return view('livewire.top-header');
    }
}

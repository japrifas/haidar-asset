<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Users extends Component
{

    public $name, $email, $username, $role, $password, $confirm_password, $selected_user_id, $blocked = 0;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortBy = 'name';
    public $perPage = '10';
    public $search = '';
    public $sortDirection = 'asc';


    protected $listeners = [
        'resetForms',
        'deleteUserHandler'
    ];

    public function render()
    {
        $users = User::query()
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        $roles = Role::all();
        return view('livewire.users', [
            'users' => $users,
            'roles' => $roles,

        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
        return $this->sortBy = $field;
    }

    public function resetForms()
    {
        $this->name = $this->email =  $this->username = $this->password = null;
        $this->resetErrorBag();
    }

    public function addUserHandler()
    {
        $this->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'username' => 'required|unique:users,username',
                'role' => 'required',
                'password' => 'required|min:8|max:25',
                'confirm_password' => 'same:password',
            ]
        );

        $query = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);
        $query->assignRole($this->role);

        if ($query) {
            // $this->emit('UpdateUserTable');
            $this->showToastr('New user has been created succesfully.', 'success');
            $this->name = $this->email =  $this->username = $this->password = null;
            $this->dispatchBrowserEvent('hide_modal_add_user');
        } else {
            $this->showToastr('Something went wrong.', 'error');
        }
    }

    public function editUser($user)
    {
        $usera = User::find($user['id']);

        $this->role = $usera->roles->pluck('name', 'name')->first();
        $this->selected_user_id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->username = $user['username'];
        $this->blocked = $user['blocked'];
        $this->dispatchBrowserEvent('showEditUserModal');
    }

    public function updateUserHandler()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|min:6|unique:users,email,' . $this->selected_user_id,
            'username' => 'required|min:6|max:20|unique:users,username,' . $this->selected_user_id
        ]);

        if ($this->selected_user_id) {
            $user = User::find($this->selected_user_id);
            $user->update([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'blocked' => $this->blocked
            ]);
            $user->syncRoles($this->role);
            $this->showToastr('User has been updated succesfully.', 'success');
            $this->dispatchBrowserEvent('hide_modal_edit_user');
        }
    }

    public function deleteUser($user)
    {
        $this->dispatchBrowserEvent('deleteUser', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete this user:<br><b>' . $user['name'] . '</b>',
            'id' => $user['id'],
        ]);

        // dd("delete user",$user);
    }

    public function deleteUserHandler($id)
    {
        $user = User::find($id);
        $path = 'back/dist/img/admin';
        $user_picture = $user->getAttributes()['picture'];
        $picture_full_path = $path . $user_picture;
        if ($user_picture != null || File::exists(public_path($picture_full_path))) {
            File::delete(public_path($picture_full_path));
        }
        $user->delete();
        $this->showToastr('User has been successfull deleted.', 'success');
    }


    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

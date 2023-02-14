<?php


namespace App\Http\Livewire;

// use App\Models\Role;
use App\Models\Role;
use Livewire\Component;
// use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
// use Spatie\Permission\Models\Permission;
use App\Models\Permission;


class Roles extends Component
{
    public $name, $selected_role_id;
    public $permission = [];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortBy = 'name';
    public $perPage = '10';
    public $search = '';
    public $sortDirection = 'asc';

    protected $listeners = [
        'resetForms',
        'deleteRoleHandler'
    ];

    public function render()
    {
        $roles = Role::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        $permission = Permission::all();
        return view('livewire.roles', [
            'roles' => $roles,
            'permissions' => $permission
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
        $this->name = null;
        $this->permission = [];
        $this->resetErrorBag();
    }

    public function addRoleHandler()
    {
        $this->validate(
            [
                'name' => 'required'
            ]
        );

        $role = Role::create([
            'name' => $this->name
        ]);

        if ($role) {
            $role->givePermissionTo($this->permission);
            // $this->emit('UpdateUserTable');
            $this->showToastr('New role has been created succesfully.', 'success');
            $this->name =  null;
            $this->dispatchBrowserEvent('hide_modal_add_role');
        } else {
            $this->showToastr('Something went wrong.', 'error');
        }
    }

    public function editRole($role)
    {
        $Roler = Role::findByName($role['name']);
        $this->permission = $Roler->permissions->pluck('id');
        $this->selected_role_id = $role['id'];
        $this->name = $role['name'];
        $this->dispatchBrowserEvent('showEditRoleModal');
    }


    public function updateRoleHandler()
    {
        $this->validate([
            'name' => 'required',
        ]);
        if ($this->selected_role_id) {
            $role = Role::find($this->selected_role_id);
            $role->update([
                'name' => $this->name
            ]);
            $role->syncPermissions($this->permission);
            $this->showToastr('Role has been updated succesfully.', 'success');
            $this->dispatchBrowserEvent('hide_modal_edit_role');
        }
    }

    public function deleteRole($role)
    {
        $this->dispatchBrowserEvent('deleteRole', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete this role:<br><b>' . $role['name'] . '</b>',
            'id' => $role['id'],
        ]);

        // dd("delete user",$user);
    }

    public function deleteRoleHandler($id)
    {
        $role = Role::find($id);
        $role->delete();
        $this->showToastr('Role has been successfull deleted.', 'success');
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

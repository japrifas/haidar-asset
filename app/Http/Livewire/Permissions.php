<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
// use Spatie\Permission\Models\Permission;
use App\Models\Permission;

class Permissions extends Component
{
    public $name, $selected_permission_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortBy = 'name';
    public $perPage = '10';
    public $search = '';
    public $sortDirection = 'asc';

    protected $listeners = [
        'resetForms',
        'deletePermissionHandler'
    ];

    public function render()
    {
        $permission = Permission::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.permissions', [
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
        $this->resetErrorBag();
    }

    public function addPermissionHandler()
    {
        $this->validate(
            [
                'name' => 'required'
            ]
        );

        $permission = Permission::create([
            'name' => $this->name
        ]);

        if ($permission) {
            // $this->emit('UpdateUserTable');
            $this->showToastr('New permission has been created succesfully.', 'success');
            $this->name =  null;
            $this->dispatchBrowserEvent('hide_modal_add_permission');
        } else {
            $this->showToastr('Something went wrong.', 'error');
        }
    }

    public function editPermission($permission)
    {
        $this->selected_permission_id = $permission['id'];
        $this->name = $permission['name'];
        $this->dispatchBrowserEvent('showEditPermissionModal');
    }

    public function updatePermissionHandler()
    {
        $this->validate([
            'name' => 'required',
        ]);
        if ($this->selected_role_id) {
            $permission = Permission::find($this->selected_permission_id);
            $permission->update([
                'name' => $this->name
            ]);
            $this->showToastr('Role has been updated succesfully.', 'success');
            $this->dispatchBrowserEvent('hide_modal_edit_role');
        }
    }

    public function deletePermission($permission)
    {
        $this->dispatchBrowserEvent('deletePermission', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete this permission:<br><b>' . $permission['name'] . '</b>',
            'id' => $permission['id'],
        ]);
    }

    public function deletePermissionHandler($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        $this->showToastr('Permission has been successfull deleted.', 'success');
    }


    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

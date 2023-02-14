<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Manufacture;
use Carbon\Carbon;
use Livewire\WithPagination;

class Manufactures extends Component
{
    public $name, $selected_manufacture_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortBy = 'name';
    public $perPage = '10';
    public $search = '';
    public $sortDirection = 'asc';

    protected $listeners = [
        'resetForms',
        'deleteManufactureHandler'
    ];
    public function resetForms()
    {
        $this->name = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        $manufacture = Manufacture::query()
            ->search(trim($this->search))
            ->where('deleted_at', '=', null)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.manufactures', [
            'manufactures' => $manufacture,


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

    public function addManufactureHandler()
    {
        $this->validate(
            [
                'name' => 'required|unique:manufactures,name'
            ],
            [
                'name.required' => 'Please Input Manufacture Name',
                'name.unique' => 'Manufacture Already Exists'
            ]
        );

        $query = Manufacture::create([
            'name' => $this->name,

        ]);

        if ($query) {
            // $this->emit('UpdateUserTable');
            $this->showToastr('New Manufacture has been created succesfully.', 'success');
            $this->name = null;
            $this->dispatchBrowserEvent('hide_modal_add_manufacture');
        } else {
            $this->showToastr('Something went wrong.', 'error');
        }
    }

    public function editManufacture($manufacture)
    {
        $this->selected_manufacture_id = $manufacture['id'];
        $this->name = $manufacture['name'];
        $this->dispatchBrowserEvent('showEditManufactureModal');
    }

    public function updateManufactureHandler()
    {
        $this->validate([
            'name' => 'required',
        ]);
        if ($this->selected_manufacture_id) {
            $manufacture = Manufacture::find($this->selected_manufacture_id);
            $manufacture->update([
                'name' => $this->name
            ]);
            $this->showToastr('Manufacture has been updated succesfully.', 'success');
            $this->dispatchBrowserEvent('hide_modal_edit_manufacture');
        }
    }


    public function deleteManufacture($manufacture)
    {
        $this->dispatchBrowserEvent('deleteManufacture', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete this manufacture:<br><b>' . $manufacture['name'] . $manufacture['id'] . '</b>',
            'id' => $manufacture['id'],
        ]);
    }
    public function deleteManufactureHandler($id)
    {
        $manufacture = Manufacture::find($id);
        $manufacture->delete();
        $this->showToastr('Manufacture has been successfull deleted.', 'success');
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

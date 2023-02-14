<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Organization;
use Livewire\WithPagination;

class Organizations extends Component
{
    public $organizationName, $selected_organization_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortBy = 'organizationName';
    public $perPage = '10';
    public $search = '';
    public $sortDirection = 'asc';

    protected $listeners = [
        'resetForms',
        'deleteOrganizationHandler'
    ];
    public function resetForms()
    {
        $this->organizationName = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        $organization = Organization::query()
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.organizations', [
            'organizations' => $organization,


        ]);
    }

    public function addOrganizationHandler()
    {
        $this->validate(
            [
                'organizationName' => 'required|unique:organizations,organizationName'
            ],
            [
                'organizationName.required' => 'Please Input Manufacture Name',
                'organizationName.unique' => 'Organization Already Exists'
            ]
        );

        $query = Organization::create([
            'organizationName' => $this->organizationName,

        ]);

        if ($query) {
            // $this->emit('UpdateUserTable');
            $this->showToastr('New Organization has been created succesfully.', 'success');
            $this->organizationName = null;
            $this->dispatchBrowserEvent('hide_modal_add_organization');
        } else {
            $this->showToastr('Something went wrong.', 'error');
        }
    }

    public function editOrganization($organization)
    {
        $this->selected_organization_id = $organization['id'];
        $this->organizationName = $organization['organizationName'];
        $this->dispatchBrowserEvent('showEditOrganizationModal');
    }

    public function updateOrganizationHandler()
    {
        $this->validate([
            'organizationName' => 'required|unique:organizations,organizationName,' . $this->selected_organization_id,
        ], [
            'organizationName.required' => 'Please input organization name!',
            'organizationName.unique' => 'Sorry , Organization Already Exists !'
        ]);
        if ($this->selected_organization_id) {
            $organization = Organization::find($this->selected_organization_id);
            $organization->update([
                'organizationName' => $this->organizationName
            ]);
            $this->showToastr('Organization has been updated succesfully.', 'success');
            $this->dispatchBrowserEvent('hide_modal_edit_organization');
        }
    }
    public function deleteOrganization($organization)
    {
        $this->dispatchBrowserEvent('deleteOrganization', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete this Organization:<br><b>' . $organization['organizationName'] . '</b>',
            'id' => $organization['id'],
        ]);
    }
    public function deleteOrganizationHandler($id)
    {
        $organization = Organization::find($id);
        $organization->delete();
        $this->showToastr('Organization has been successfull deleted.', 'success');
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

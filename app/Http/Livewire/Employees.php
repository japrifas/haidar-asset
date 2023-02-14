<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Organization;
use Livewire\WithPagination;


class Employees extends Component
{
    public $employeeId, $employeeName, $organization_id, $jobPosition, $email, $selected_employee_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortBy = 'employeeId';
    public $perPage = '10';
    public $search = '';
    public $sortDirection = 'asc';
    protected $listeners = [
        'resetForms',
        'deleteEmployeeHandler'
    ];
    public function resetForms()
    {
        $this->employeeId = $this->employeeName =  $this->organization_id = $this->email  = $this->jobPosition = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        $employee = Employee::query()
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        $organization = Organization::all();
        return view('livewire.employees', [
            'employees' => $employee,
            'organizations' => $organization,


        ]);
    }
    public function addEmployeeHandler()
    {
        $this->validate(
            [
                'employeeId' => 'required|unique:employees,employeeId',
                'employeeName' => 'required|min:5',
                'email' => 'required|email',
                'jobPosition' => 'required|min:5',
                'organization_id' => 'required'
            ],
            // [
            //     'name.required' => 'Please Input Manufacture Name',
            //     'name.unique' => 'Manufacture Already Exists'
            // ]
        );

        $query = Employee::create([
            'employeeId' => $this->employeeId,
            'employeeName' => $this->employeeName,
            'email' => $this->email,
            'organization_id' => $this->organization_id,
            'jobPosition' => $this->jobPosition


        ]);

        if ($query) {
            // $this->emit('UpdateUserTable');
            $this->showToastr('New Employee has been added succesfully.', 'success');
            $this->employeeId = $this->employeeName = $this->organization_id = $this->email = $this->jobPosition = null;
            $this->dispatchBrowserEvent('hide_modal_add_employee');
        } else {
            $this->showToastr('Something went wrong.', 'error');
        }
    }

    public function editEmployee($employee)
    {
        $this->selected_employee_id = $employee['id'];
        $this->employeeId = $employee['employeeId'];
        $this->employeeName = $employee['employeeName'];
        $this->email = $employee['email'];
        $this->organization_id = $employee['organization_id'];
        $this->jobPosition = $employee['jobPosition'];
        $this->dispatchBrowserEvent('showEditEmployeeModal');
    }

    public function updateEmployeeHandler()
    {
        $this->validate([
            'employeeId' => 'required|unique:employees,employeeId,' .   $this->selected_employee_id,
            'employeeName' => 'required|min:5',
            'email' => 'required|email|unique:employees,email,' .   $this->selected_employee_id,
            'jobPosition' => 'required|min:5',
            'organization_id' => 'required',
        ]);
        if ($this->selected_employee_id) {
            $employee = Employee::find($this->selected_employee_id);
            $employee->update([
                'employeeId' => $this->employeeId,
                'employeeName' => $this->employeeName,
                'email' => $this->email,
                'organization_id' => $this->organization_id,
                'jobPosition' => $this->jobPosition
            ]);
            $this->showToastr('Employee Data has been updated succesfully.', 'success');
            $this->dispatchBrowserEvent('hide_modal_edit_employee');
        }
    }
    public function deleteEmployee($employee)
    {
        $this->dispatchBrowserEvent('deleteEmployee', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete this Employee:<br><b>' . $employee['employeeName'] . '</b>',
            'id' => $employee['id'],
        ]);
    }
    public function deleteEmployeeHandler($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        $this->showToastr('Empoyee Data has been successfull deleted.', 'success');
    }
    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

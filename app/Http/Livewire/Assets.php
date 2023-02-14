<?php

namespace App\Http\Livewire;

use App\Models\Asset;
use App\Models\AssetHistory;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Manufacture;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Assets extends Component
{
    public $assetTag, $assetName, $assetAntivirus, $assetStatus, $assetModel, $assetManufacture, $assetRam, $assetProcessor, $assetWindows, $selected_asset_id, $assetCheckinDate, $assetCheckoutDate, $employeeId, $assetNote;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortBy = 'created_at';
    public $perPage = '10';
    public $search = '';
    public $sortDirection = 'DESC';
    protected $listeners = [
        // 'resetForms',
        'deleteAssetHandler'
    ];

    public function mount()
    {
        $assetTag = Str::random(12);
        $this->assetTag = $assetTag;
        $assetCheckinDate = Carbon::now();
        $this->assetCheckinDate = $assetCheckinDate;
    }
    public function resetForms()
    {
        $this->assetTag = $this->assetName =  $this->assetStatus = $this->assetAntivirus
            = $this->assetModel  = $this->assetManufacture = $this->assetRam
            = $this->assetProcessor = $this->assetWindows
            = null;
        $this->resetErrorBag();
    }


    public function render()
    {
        $asset = Asset::query()
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        $manufacture = Manufacture::all();
        $employee = Employee::all();
        return view('livewire.assets', [
            'employees' => $employee,
            'manufactures' => $manufacture,
            'assets' => $asset


        ]);
    }

    public function addAssetHandler()
    {
        $this->validate(
            [
                'assetTag' => 'required|unique:assets,assetTag',
                'assetName' => 'required|min:5',
                'assetAntivirus' => 'required',
                'assetStatus' => 'required',
                'assetModel' => 'required|min:5',
                'assetManufacture' => 'required',
                'assetRam' => 'required',
                'assetProcessor' => 'required|min:5',
                'assetWindows' => 'required'

            ],
            // [
            //     'name.required' => 'Please Input Manufacture Name',
            //     'name.unique' => 'Manufacture Already Exists'
            // ]
        );

        $query = Asset::create([
            'assetTag' => $this->assetTag,
            'assetName' => $this->assetName,
            'antivirus' => $this->assetAntivirus,
            'status' => $this->assetStatus,
            'model' => $this->assetModel,
            'manufacture_id' => $this->assetManufacture,
            'ram' => $this->assetRam,
            'processor' => $this->assetProcessor,
            'windows' => $this->assetWindows


        ]);

        if ($query) {
            // $this->emit('UpdateUserTable');
            $this->showToastr('New Asset has been added succesfully.', 'success');
            $this->assetTag = $this->assetName =  $this->assetStatus = $this->assetAntivirus
                = $this->assetModel  = $this->assetManufacture = $this->assetRam
                = $this->assetProcessor = $this->assetWindows
                = null;
            $this->dispatchBrowserEvent('hide_modal_add_asset');
        } else {
            $this->showToastr('Something went wrong.', 'error');
        }
    }

    public function editAsset($asset)
    {
        $this->selected_asset_id = $asset['id'];
        $this->assetTag = $asset['assetTag'];
        $this->assetName = $asset['assetName'];
        $this->assetAntivirus = $asset['antivirus'];
        $this->assetModel = $asset['model'];
        $this->assetManufacture = $asset['manufacture_id'];
        $this->assetRam = $asset['ram'];
        $this->assetProcessor = $asset['processor'];
        $this->assetWindows = $asset['windows'];
        $this->assetStatus = $asset['status'];
        $this->dispatchBrowserEvent('showEditAssetModal');
    }
    public function updateAssetHandler()
    {
        $this->validate([
            'assetTag' => 'required|unique:employees,employeeId,' .   $this->selected_asset_id,
            'assetName' => 'required|min:5,' . $this->selected_asset_id,
            'assetAntivirus' => 'required',
            'assetModel' => 'required',
            'assetManufacture' => 'required',
            'assetRam' => 'required',
            'assetProcessor' => 'required',
            'assetWindows' => 'required',
            'assetStatus' => 'required'
        ]);
        if ($this->selected_asset_id) {
            $asset = Asset::find($this->selected_asset_id);
            $asset->update([
                'assetTag' => $this->assetTag,
                'assetName' => $this->assetName,
                'status' => $this->assetStatus,
                'model' => $this->assetModel,
                'manufacture_id' => $this->assetManufacture,
                'ram' => $this->assetRam,
                'processor' => $this->assetProcessor,
                'windows' => $this->assetWindows,
                'antivirus' => $this->assetAntivirus
            ]);
            $this->showToastr('Asset Data has been updated succesfully.', 'success');
            $this->dispatchBrowserEvent('hide_modal_edit_asset');
        }
    }

    public function checkinAsset($asset)
    {
        $this->selected_asset_id = $asset['id'];
        $this->assetTag = $asset['assetTag'];
        $this->assetName = $asset['assetName'];
        // $this->email = $employee['email'];
        // $this->organization_id = $employee['organization_id'];
        // $this->jobPosition = $employee['jobPosition'];
        $this->dispatchBrowserEvent('showCheckinAssetModal');
    }

    public function checkinAssetHandler()
    {
        // $this->validate([
        //     'employeeId' => 'required|unique:employees,employeeId,' .   $this->selected_employee_id,
        //     'employeeName' => 'required|min:5',
        //     'email' => 'required|email|unique:employees,email,' .   $this->selected_employee_id,
        //     'jobPosition' => 'required|min:5',
        //     'organization_id' => 'required',
        // ]);
        if ($this->selected_asset_id) {
            $asset = Asset::find($this->selected_asset_id);
            $asset->update([
                'employee_id' => $this->employeeId,
                'status' => "stock"
            ]);
            AssetHistory::create([
                'asset_id' => $this->selected_asset_id,
                'employee_id' => null,
                'inout_date' => $this->assetCheckinDate,
                'action' => "checkin",
                'note' => $this->assetNote,
            ]);
            $this->showToastr('ASset Has been CheckedIn.', 'success');
            $this->selected_asset_id = $this->employeeId = $this->assetCheckinDate = $assetNote = null;
            $this->dispatchBrowserEvent('hide_modal_checkinAsset');
        }
    }

    public function checkoutAsset($asset)
    {
        $this->selected_asset_id = $asset['id'];
        $this->assetTag = $asset['assetTag'];
        $this->assetName = $asset['assetName'];
        // $this->email = $employee['email'];
        // $this->organization_id = $employee['organization_id'];
        // $this->jobPosition = $employee['jobPosition'];
        $this->dispatchBrowserEvent('showCheckoutAssetModal');
    }
    public function checkoutAssetHandler()
    {
        // $this->validate([
        //     'employeeId' => 'required|unique:employees,employeeId,' .   $this->selected_employee_id,
        //     'employeeName' => 'required|min:5',
        //     'email' => 'required|email|unique:employees,email,' .   $this->selected_employee_id,
        //     'jobPosition' => 'required|min:5',
        //     'organization_id' => 'required',
        // ]);
        if ($this->selected_asset_id) {
            $asset = Asset::find($this->selected_asset_id);
            $asset->update([
                'employee_id' => $this->employeeId,
                'status' => "assigned"
            ]);
            AssetHistory::create([
                'asset_id' => $this->selected_asset_id,
                'employee_id' => $this->employeeId,
                'inout_date' => $this->assetCheckoutDate,
                'action' => "checkout",
                'note' => $this->assetNote,
            ]);
            $this->showToastr('ASset Has been CheckedOut.', 'success');
            $this->selected_asset_id = $this->employeeId = $this->assetCheckoutDate = $assetNote = null;
            $this->dispatchBrowserEvent('hide_modal_checkoutAsset');
        }
    }


    public function deleteAsset($asset)
    {
        $this->dispatchBrowserEvent('deleteAsset', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete this Asset:<br><b>' . $asset['assetName'] . '</b>',
            'id' => $asset['id'],
        ]);
    }
    public function deleteAssetHandler($id)
    {
        $asset = Asset::find($id);
        $asset->delete();
        $this->showToastr('Asset Data has been successfull deleted.', 'success');
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

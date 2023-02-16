<div>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom py-3">
                    <div class="d-flex ">
                        <div class="text-muted">
                            Show
                            <div class="mx-2 d-inline-block">
                                <select class="form-select" wire:model="perPage">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            entries
                        </div>
                        <div class="ms-auto text-muted">
                            Search:
                            <div class="ms-2 d-inline-block">
                                <input type="text" wire:model="search" class="form-control form-control-md"
                                    placeholder="Search User...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                {{-- <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                            aria-label="Select all invoices"></th> --}}
                                <th wire:click="sortBy('assetTag')" style="cursor: pointer;">Asset Tag
                                    @include('back.partials._sort-icon', ['field' => 'assetTag'])</th>
                                <th wire:click="sortBy('assetName')" style="cursor: pointer;">Asset Name
                                    @include('back.partials._sort-icon', ['field' => 'assetName'])</th>
                                <th wire:click="sortBy('manufacture')" style="cursor: pointer;">manufacture
                                    @include('back.partials._sort-icon', ['field' => 'manufacture'])</th>
                                <th wire:click="sortBy('status')" style="cursor: pointer;">Status
                                    @include('back.partials._sort-icon', ['field' => 'status'])</th>
                                <th wire:click="sortBy('employee')" style="cursor: pointer;">Employee
                                    @include('back.partials._sort-icon', ['field' => 'employee'])</th>
                                <th wire:click="sortBy('created_at')" style="cursor: pointer;">Created At
                                    @include('back.partials._sort-icon', ['field' => 'created_at'])</th>

                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($assets as $asset)
                                <tr>
                                    <td>{{ $asset->assetTag }}</td>
                                    <td><span class="badge bg-yellow"> {{ $asset->assetName }} </span>
                                    </td>
                                    <td>{{ $asset->manufacture->name }}</td>
                                    <td>
                                        @if ($asset->status == 'assigned')
                                            <span class="badge bg-red">{{ $asset->status }}</span>
                                        @else
                                            <span class="badge bg-green">{{ $asset->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($asset->employee_id == null)
                                            -
                                        @else
                                            {{ $asset->employee->employeeName }}
                                        @endif
                                    </td>
                                    <td>{{ $asset->created_at }}</td>



                                    <td>
                                        {{-- <a href="#" wire:click.prevent="editAsset({{ $asset }})"
                                            class="btn btn-outline-primary btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye-filled" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22 .379l.045 .1l.03 .083l.014 .055l.014 .082l.011 .1v.11l-.014 .111a.992 .992 0 0 1 -.026 .11l-.039 .108l-.036 .075l-.016 .03c-2.764 4.836 -6.3 7.38 -10.555 7.499l-.313 .004c-4.396 0 -8.037 -2.549 -10.868 -7.504a1 1 0 0 1 0 -.992c2.831 -4.955 6.472 -7.504 10.868 -7.504zm0 5a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                                    stroke-width="0" fill="currentColor"></path>
                                            </svg>
                                        </a>&nbsp;

                                        <a href="#" wire:click.prevent="editAsset({{ $asset }})"
                                            class="btn btn-outline-primary btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                </path>
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                </path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                        </a>&nbsp;

                                        <a href="#" wire:click.prevent="deleteAsset({{ $asset }})"
                                            class="btn btn-outline-danger btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="4" y1="7" x2="20" y2="7">
                                                </line>
                                                <line x1="10" y1="11" x2="10" y2="17">
                                                </line>
                                                <line x1="14" y1="11" x2="14" y2="17">
                                                </line>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                            </svg>
                                        </a>&nbsp;


                                        @if ($asset->status == 'stock')
                                            <a href="#" wire:click.prevent="checkoutAsset({{ $asset }})"
                                                class="btn btn-outline-success btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-narrow-up"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 5l0 14"></path>
                                                    <path d="M16 9l-4 -4"></path>
                                                    <path d="M8 9l4 -4"></path>
                                                </svg>
                                            </a>
                                        @else
                                            <a href="#" wire:click.prevent="checkinAsset({{ $asset }})"
                                                class="btn btn-outline-success btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-arrow-narrow-down"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 5l0 14"></path>
                                                    <path d="M16 15l-4 4"></path>
                                                    <path d="M8 15l4 4"></path>
                                                </svg>
                                            </a>
                                        @endif --}}

                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top"
                                                data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#"
                                                    wire:click.prevent="detailAsset({{ $asset }})">
                                                    Detail
                                                </a>
                                                <a class="dropdown-item" href="#"
                                                    wire:click.prevent="editAsset({{ $asset }})">
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="#"
                                                    wire:click.prevent="deleteAsset({{ $asset }})">
                                                    Delete
                                                </a>
                                                @if ($asset->status == 'stock')
                                                    <a class="dropdown-item" href="#"
                                                        wire:click.prevent="checkoutAsset({{ $asset }})">
                                                        Check Out
                                                    </a>
                                                @else
                                                    <a class="dropdown-item" href="#"
                                                        wire:click.prevent="checkinAsset({{ $asset }})">
                                                        Check In
                                                    </a>
                                                @endif

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" align="center"><span class="text-muted">No Data
                                            Available</span></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">
                    <div>Showing {{ ($assets->currentpage() - 1) * $assets->perpage() + 1 }} to
                        {{ $assets->currentpage() * $assets->perpage() }}
                        of {{ $assets->total() }} entries
                    </div>
                    </p>
                    <p class="pagination m-0 ms-auto">
                        {{ $assets->links() }}
                    </p>
                </div>
            </div>
        </div>
    </div>


    {{-- modal ADD --}}
    <div wire:ignore.self class="modal modal-blur fade" id="modal_add_asset" tabindex="-1" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='addAssetHandler()' method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Asset Tag</label>
                                    <input type="text" class="form-control" wire:model='assetTag' disabled>
                                    @error('assetTag')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Asset Name</label>
                                    <input type="text" class="form-control" placeholder="Input Asset Name"
                                        wire:model='assetName'>
                                    @error('assetName')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Antivirus</div>
                                    <select class="form-select " style="width:100%;" wire:model='assetAntivirus'>
                                        <option value="">-- Select --</option>
                                        <option value="kaspersky">Kaspersky</option>
                                        <option value="other">Other</option>

                                    </select>
                                    @error('assetAntivirus')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Model</label>
                                    <input type="text" class="form-control" placeholder="Asset Model"
                                        wire:model='assetModel'>
                                    @error('assetModel')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Manufacture</div>
                                    <select class="form-select" style="width:100%;" wire:model='assetManufacture'>
                                        <option value="">-- Select --</option>
                                        @foreach ($manufactures as $manufacture)
                                            <option value="{{ $manufacture->id }}">{{ $manufacture->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Ram</label>
                                    <select class="form-control" wire:model='assetRam'>
                                        <option value="">-- Select --</option>
                                        <option value="4 GB">4 GB</option>
                                        <option value="8 GB">8 GB</option>
                                        <option value="16 GB">16 GB</option>
                                        <option value="32 GB">32 GB</option>
                                    </select>

                                    @error('assetRam')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Processor</div>
                                    <input type="text" class="form-control" style="width:100%;"
                                        wire:model='assetProcessor'>

                                    </input>
                                    @error('assetProcessor')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Windows</label>
                                    <select class="form-control" wire:model='assetWindows'>
                                        <option value="">-- Select --</option>
                                        <option value="Windows 10 SL">Windows 10 SL</option>
                                        <option value="Windows 10 Pro">Windows 10 Pro</option>
                                        <option value="Mac Os">Mac Os</option>
                                        <option value="Linux">Linux</option>
                                        <option value="Windows 11 SL">Windows 11 SL</option>
                                        <option value="Windows 11 Pro">Windows 11 Pro</option>
                                    </select>

                                    @error('assetWindows')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-label">Status</div>
                                <select class="form-select " style="width:100%;" wire:model='assetStatus'>
                                    <option value="">-- Select --</option>
                                    <option value="stock">On Stock</option>
                                    <option value="assigned">Assigned</option>

                                </select>
                                @error('assetStatus')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- MODAL EDIT --}}
    <div wire:ignore.self class="modal modal-blur fade" id="modal_edit_asset" tabindex="-1" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='updateAssetHandler()' method="post">
                        <input type="hidden" class="form-control" wire:model='selected_asset_id'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Asset Tag</label>
                                    <input type="text" class="form-control" wire:model='assetTag' disabled>
                                    @error('assetTag')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Asset Name</label>
                                    <input type="text" class="form-control" placeholder="Input Asset Name"
                                        wire:model='assetName'>
                                    @error('assetName')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Antivirus</div>
                                    <select class="form-select " style="width:100%;" wire:model='assetAntivirus'>


                                        <option value="kaspersky">Kaspersky</option>
                                        <option value="other">Other</option>



                                    </select>
                                    @error('assetAntivirus')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Model</label>
                                    <input type="text" class="form-control" placeholder="Asset Model"
                                        wire:model='assetModel'>
                                    @error('assetModel')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Manufacture</div>
                                    <select class="form-select" style="width:100%;" wire:model='assetManufacture'>

                                        @foreach ($manufactures as $manufacture)
                                            <option value="{{ $manufacture->id }}">{{ $manufacture->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Ram</label>
                                    <select class="form-control" wire:model='assetRam'>

                                        <option value="4 GB">4 GB</option>
                                        <option value="8 GB">8 GB</option>
                                        <option value="16 GB">16 GB</option>
                                        <option value="32 GB">32 GB</option>
                                    </select>

                                    @error('assetRam')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Processor</div>
                                    <input type="text" class="form-control" style="width:100%;"
                                        wire:model='assetProcessor'>

                                    </input>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Windows</label>
                                    <select class="form-control" wire:model='assetWindows'>

                                        <option value="Windows 10 SL">Windows 10 SL</option>
                                        <option value="Windows 10 Pro">Windows 10 Pro</option>
                                        <option value="Mac Os">Mac Os</option>
                                        <option value="Linux">Linux</option>
                                        <option value="Windows 11 SL">Windows 11 SL</option>
                                        <option value="Windows 11 Pro">Windows 11 Pro</option>
                                    </select>

                                    @error('assetModel')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-label">Status</div>
                                <select class="form-select " style="width:100%;" wire:model='assetStatus'>

                                    <option value="stock">On Stock</option>
                                    <option value="assigned">Assigned</option>

                                </select>
                                @error('assetStatus')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal checkin --}}
    <div wire:ignore.self class="modal modal-blur fade" id="modal_checkin_asset" tabindex="-1" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Check In Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='checkinAssetHandler()' method="post">
                        <input type="hidden" class="form-control" wire:model='selected_asset_id'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Asset Tag</label>
                                    <input type="text" class="form-control" placeholder="Input Manufacture Name"
                                        wire:model='assetTag' disabled>
                                    @error('assetTag')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Asset Name</label>
                                    <input type="text" class="form-control" placeholder="Input Manufacture Name"
                                        wire:model='assetName' disabled>
                                    @error('assetName')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Check In Date</label>
                                    <input type="datetime-local" class="form-control"
                                        placeholder="Input Manufacture Name" wire:model='assetCheckinDate'>
                                    @error('assetCheckinDate')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Note</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="10" wire:model='assetNote'></textarea>

                                    @error('assetNote')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal checkout --}}
    <div wire:ignore.self class="modal modal-blur fade" id="modal_checkout_asset" tabindex="-1" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Check Out Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='checkoutAssetHandler()' method="post">
                        <input type="hidden" class="form-control" wire:model='selected_asset_id'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Asset Tag</label>
                                    <input type="text" class="form-control" placeholder="Input Manufacture Name"
                                        wire:model='assetTag' disabled>
                                    @error('assetTag')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Asset Name</label>
                                    <input type="text" class="form-control" placeholder="Input Manufacture Name"
                                        wire:model='assetName' disabled>
                                    @error('assetName')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Check Out Date</label>
                                    <input type="datetime-local" class="form-control"
                                        placeholder="Input Manufacture Name" wire:model='assetCheckoutDate'>
                                    @error('assetCheckinDate')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee</label>
                                    <select class="form-select" wire:model='employeeId'>
                                        <option value="">-- Select Employee --</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->employeeName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Note</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="10" wire:model='assetNote'></textarea>

                                    @error('assetNote')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal detail asset --}}
    <div wire:ignore.self class="modal modal-blur fade" id="modal_detail_asset" tabindex="-1" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $assetName }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="#tabs-home-10" class="nav-link active" data-bs-toggle="tab"
                                            aria-selected="true" role="tab">Detail</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#tabs-profile-10" class="nav-link" data-bs-toggle="tab"
                                            aria-selected="false" role="tab" tabindex="-1">History</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="tabs-home-10" role="tabpanel">

                                        <div>

                                            <table class="datatable">
                                                <tr>
                                                    <td width="250">Asset Tag</td>
                                                    <td>{{ $assetTag }} </td>
                                                </tr>


                                                <tr>
                                                    <td>Model</td>
                                                    <td>{{ $assetModel }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Manufacture</td>
                                                    <td>{{ $assetManufacture }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ram</td>
                                                    <td>{{ $assetRam }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Processor</td>
                                                    <td>{{ $assetProcessor }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Os</td>
                                                    <td>{{ $assetWindows }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Antivirus</td>
                                                    <td>{{ $assetAntivirus }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Employee</td>
                                                    <td>
                                                        {{ $assetEmployee }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-profile-10" role="tabpanel">


                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Asset Name</th>
                                                        <th>Employee</th>
                                                        <th>Status</th>
                                                        <th>Note</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (is_array($assetHistories) || is_object($assetHistories))
                                                        @forelse ($assetHistories as $ah)
                                                            <tr>
                                                                <td>
                                                                    {{ $ah->created_at }}</td>


                                                                <td>{{ $ah->asset->assetName }}</td>
                                                                <td>
                                                                    @if ($ah->employee_id == null)
                                                                        -
                                                                    @else
                                                                        {{ $ah->employee->employeeName }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $ah->action }}</td>
                                                                <td>{{ $ah->note }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" align="center"><span
                                                                        class="text-muted">No Data
                                                                        Available</span></td>
                                                            </tr>
                                                        @endforelse
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

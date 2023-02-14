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
                                    placeholder="Search Employee...">
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
                                <th wire:click="sortBy('employeeId')" style="cursor: pointer;">
                                    Employee ID
                                    @include('back.partials._sort-icon', ['field' => 'employeeId'])
                                </th>
                                <th wire:click="sortBy('employeeName')" style="cursor: pointer;">Employee Name
                                    @include('back.partials._sort-icon', ['field' => 'employeeName'])</th>
                                <th wire:click="sortBy('email')" style="cursor: pointer;">Email
                                    @include('back.partials._sort-icon', ['field' => 'email'])</th>
                                <th wire:click="sortBy('organization')" style="cursor: pointer;">Organization
                                    @include('back.partials._sort-icon', ['field' => 'organization'])</th>
                                <th wire:click="sortBy('jobPosition')" style="cursor: pointer;">Job Position
                                    @include('back.partials._sort-icon', ['field' => 'jobPosition'])</th>


                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr>
                                    {{-- <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select invoice"></td> --}}
                                    <td>{{ $employee->employeeId }} </td>
                                    <td>{{ $employee->employeeName }} </td>
                                    <td>{{ $employee->email }} </td>
                                    <td>{{ $employee->organization->organizationName }} </td>
                                    <td>{{ $employee->jobPosition }} </td>



                                    <td>

                                        <a href="#" wire:click.prevent="editEmployee({{ $employee }})"
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

                                        @can('delete manufacture')
                                            <a href="#" wire:click.prevent="deleteEmployee({{ $employee }})"
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
                                            </a>
                                        @endcan
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
                    <div>Showing {{ ($employees->currentpage() - 1) * $employees->perpage() + 1 }} to
                        {{ $employees->currentpage() * $employees->perpage() }}
                        of {{ $employees->total() }} entries
                    </div>
                    </p>
                    <p class="pagination m-0 ms-auto">
                        {{ $employees->links() }}
                    </p>
                </div>
            </div>
        </div>
    </div>


    {{-- modal --}}
    <div wire:ignore.self class="modal modal-blur fade" id="modal_add_employee" tabindex="-1" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='addEmployeeHandler()' method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee Id</label>
                                    <input type="text" class="form-control" placeholder="Input Employee ID"
                                        wire:model='employeeId'>
                                    @error('employeeId')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Employee Name</div>
                                    <input type="text" class="form-control" placeholder="Input Employee Name"
                                        wire:model='employeeName'>
                                    @error('employeeName')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee Email</label>
                                    <input type="text" class="form-control" placeholder="Input Employee Email"
                                        wire:model='email'>
                                    @error('email')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Organization</div>
                                    <select class="form-select" style="width:100%;" wire:model='organization_id'>
                                        <option value="">Select Organization</option>
                                        @forelse ($organizations as $organization)
                                            <option value="{{ $organization->id }}">
                                                {{ $organization->organizationName }}</option>
                                        @empty
                                            <option value="">- Empty -</option>
                                        @endforelse

                                    </select>
                                    @error('organization_id')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Job Position</label>
                                    <input type="text" class="form-control" placeholder="Input Job Position"
                                        wire:model='jobPosition'>
                                    @error('jobPosition')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
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

    <div wire:ignore.self class="modal modal-blur fade" id="modal_edit_employee" tabindex="-1" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update ManuEmployeefacture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='updateEmployeeHandler()' method="post">
                        <input type="hidden" class="form-control" wire:model='selected_employee_id'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee Id</label>
                                    <input type="text" class="form-control" placeholder="Input Employee ID"
                                        wire:model='employeeId'>
                                    @error('employeeId')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Employee Name</div>
                                    <input type="text" class="form-control" placeholder="Input Employee Name"
                                        wire:model='employeeName'>
                                    @error('employeeName')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee Email</label>
                                    <input type="text" class="form-control" placeholder="Input Employee Email"
                                        wire:model='email'>
                                    @error('email')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Organization</div>
                                    <select class="form-select" style="width:100%;" wire:model='organization_id'>
                                        <option value="">Select Organization</option>
                                        @forelse ($organizations as $organization)
                                            <option value="{{ $organization->id }}">
                                                {{ $organization->organizationName }}</option>
                                        @empty
                                            <option value="">- Empty -</option>
                                        @endforelse

                                    </select>
                                    @error('organization_id')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Job Position</label>
                                    <input type="text" class="form-control" placeholder="Input Job Position"
                                        wire:model='jobPosition'>
                                    @error('jobPosition')
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
</div>

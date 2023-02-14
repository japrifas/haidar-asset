<div>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
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
                                <th wire:click="sortBy('organizationName')" style="cursor: pointer;">
                                    Employee ID
                                    @include('back.partials._sort-icon', ['field' => 'employeeId'])
                                </th>


                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($organizations as $organization)
                                <tr>
                                    {{-- <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select invoice"></td> --}}
                                    <td>{{ $organization->organizationName }} </td>



                                    <td>

                                        <a href="#" wire:click.prevent="editOrganization({{ $organization }})"
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


                                        <a href="#" wire:click.prevent="deleteOrganization({{ $organization }})"
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
                    <div>Showing {{ ($organizations->currentpage() - 1) * $organizations->perpage() + 1 }} to
                        {{ $organizations->currentpage() * $organizations->perpage() }}
                        of {{ $organizations->total() }} entries
                    </div>
                    </p>
                    <p class="pagination m-0 ms-auto">
                        {{ $organizations->links() }}
                    </p>
                </div>
            </div>
        </div>
    </div>


    {{-- modal --}}
    <div wire:ignore.self class="modal modal-blur fade" id="modal_add_organization" tabindex="-1" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Organization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='addOrganizationHandler()' method="post">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Organization Name</label>
                                    <input type="text" class="form-control" placeholder="Input Organization Name"
                                        wire:model='organizationName'>
                                    @error('organizationName')
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

    <div wire:ignore.self class="modal modal-blur fade" id="modal_edit_organization" tabindex="-1"
        aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Organization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='updateOrganizationHandler()' method="post">
                        <input type="hidden" class="form-control" wire:model='selected_organization_id'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Organization Name</label>
                                    <input type="text" class="form-control" placeholder="Input Organization Name"
                                        wire:model='organizationName'>
                                    @error('organizationName')
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

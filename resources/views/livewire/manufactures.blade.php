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
                                <th wire:click="sortBy('name')" style="cursor: pointer;">
                                    Name
                                    @include('back.partials._sort-icon', ['field' => 'name'])
                                </th>
                                <th wire:click="sortBy('created_at')" style="cursor: pointer;">Created
                                    @include('back.partials._sort-icon', ['field' => 'created_at'])</th>


                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($manufactures as $manufacture)
                                <tr>
                                    {{-- <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select invoice"></td> --}}
                                    <td>{{ $manufacture->name }} </td>
                                    <td>{{ $manufacture->created_at }} </td>



                                    <td>

                                        <a href="#" wire:click.prevent="editManufacture({{ $manufacture }})"
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
                                            <a href="#" wire:click.prevent="deleteManufacture({{ $manufacture }})"
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
                    <div>Showing {{ ($manufactures->currentpage() - 1) * $manufactures->perpage() + 1 }} to
                        {{ $manufactures->currentpage() * $manufactures->perpage() }}
                        of {{ $manufactures->total() }} entries
                    </div>
                    </p>
                    <p class="pagination m-0 ms-auto">
                        {{ $manufactures->links() }}
                    </p>
                </div>
            </div>
        </div>
    </div>


    {{-- modal --}}
    <div wire:ignore.self class="modal modal-blur fade" id="modal_add_manufacture" tabindex="-1" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Manufactures</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='addManufactureHandler()' method="post">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Manufacture Name</label>
                                    <input type="text" class="form-control" placeholder="Input Manufacture Name"
                                        wire:model='name'>
                                    @error('name')
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

    <div wire:ignore.self class="modal modal-blur fade" id="modal_edit_manufacture" tabindex="-1"
        aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Manufacture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='updateManufactureHandler()' method="post">
                        <input type="hidden" class="form-control" wire:model='selected_manufacture_id'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Manufacture Name</label>
                                    <input type="text" class="form-control" placeholder="Input Manufacture Name"
                                        wire:model='name'>
                                    @error('name')
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

@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Roles')
@section('pageHeader')
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
                Roles
            </h2>
        </div>
        @can('create role')
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                        data-bs-target="#modal_add_role">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Create Role
                    </a>
                </div>
            </div>
        @endcan
    </div>
@endsection
@section('content')
    @livewire('roles')
@endsection

@push('scripts')
    <script>
        $(window).on('hidden.bs.modal', function() {
            livewire.emit('resetForms');
        });
        window.addEventListener('hide_modal_add_role', function(event) {
            $('#modal_add_role').modal('hide');
        });
        window.addEventListener('showEditRoleModal', function(event) {
            $('#modal_edit_role').modal('show');
        });
        window.addEventListener('hide_modal_edit_role', function(event) {
            $('#modal_edit_role').modal('hide');
        });
        window.addEventListener('deleteRole', function(event) {
            swal.fire({
                title: event.detail.title,
                imageWidth: 48,
                imageHeight: 48,
                icon: 'warning',
                html: event.detail.html,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes,delete',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    livewire.emit('deleteRoleHandler', event.detail.id);
                }
            });
        });
    </script>
@endpush

@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Account Setting')
@section('pageHeader')
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
                Account Setting
            </h2>
        </div>
    </div>
@endsection
@section('content')
    @livewire('admin-profile-header')
    <hr>
    <div class="row">
        <div class="card">
            <ul class="nav nav-tabs" data-bs-toggle="tabs">
                <li class="nav-item">
                    <a href="#tabs-details" class="nav-link active" data-bs-toggle="tab">Personal Detail</a>
                </li>
                <li class="nav-item">
                    <a href="#tabs-password" class="nav-link" data-bs-toggle="tab">Change Password</a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-details">
                        @livewire('admin-profile-detail')
                    </div>
                    <div class="tab-pane" id="tabs-password">
                        @livewire('admin-change-password')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#changeAdminPictureFile').ijaboCropTool({
            preview: '',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('admin.change-profile-picture') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                Livewire.emit('UpdateAdminProfileHeader');
                Livewire.emit('UpdateTopHeader');
                toastr.success(message);
            },
            onError: function(message, element, status) {
                alert(message);
            }
        });
    </script>
@endpush

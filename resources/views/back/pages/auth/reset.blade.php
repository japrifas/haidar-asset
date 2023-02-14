@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Reset Password')
@section('content')

    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img
                        src="{{ asset('back/static/logo_thunder.png') }}" height="50" alt=""></a>
            </div>
            @livewire('admin-change-password-form')
        </div>
    </div>

@endsection

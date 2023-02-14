@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login Page')
@section('content')

    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand "><img src="{{ asset('back/static/haidar.png') }}" height="150"
                        alt="" style="box-shadow: 2rem; filter: drop-shadow(5px 5px 5px #222);"></a>
            </div>
            @livewire('admin-login-form')
        </div>
    </div>

@endsection

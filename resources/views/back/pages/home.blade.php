@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')
@section('pageHeader')
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
                Dashboard
            </h2>
        </div>
    </div>
@endsection

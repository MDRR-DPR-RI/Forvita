@extends('dashboard.layouts.main')

@section('custom_vendor')
    <!-- Vendor CSS -->
@endsection
@parent

@section('page_content')
    <div class="main main-app p-3 p-lg-4">
        <h1> User Management </h1>
        <livewire:user-management.user-listing/>
        <livewire:user-management.edit-user/>
    </div>
@endsection

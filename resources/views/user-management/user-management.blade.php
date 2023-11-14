@extends('dashboard.layouts.main')

@section('custom_vendor')
    <!-- Vendor CSS -->
@endsection
@parent

@section('page_content')
    <div class="main main-app p-3 p-lg-4">
        <h1> Manajemen Pengguna </h1>
        <livewire:user-management.user-listing/>
    </div>
@endsection

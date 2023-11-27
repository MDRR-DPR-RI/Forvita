@extends('dashboard.layouts.main')

@section('custom_vendor')
    <!-- Vendor CSS -->
@endsection
@parent

@section('page_content')
    <div class="main main-app p-3 p-lg-4">
        <h1> Daftar Tabel Data </h1>
        <livewire:data-table.data-table-listing/>
    </div>
@endsection

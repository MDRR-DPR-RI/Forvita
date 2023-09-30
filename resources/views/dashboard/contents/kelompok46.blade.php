@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
<div class="d-md-flex align-items-center justify-content-between mb-4">
  <div>
    <ol class="breadcrumb fs-sm mb-1">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Kelompok 4 & 6</li>
    </ol>
    <h4 class="main-title mb-0">Kelompok 4 & 6</h4>
  </div>

  <div class="d-flex gap-2 mt-3 mt-md-0">
    <button type="button" class="btn btn-white d-flex align-items-center gap-2"><i class="ri-share-line fs-18 lh-1"></i>Share</button>
    <button type="button" class="btn btn-white d-flex align-items-center gap-2"><i class="ri-printer-line fs-18 lh-1"></i>Print</button>
    <a href="#modal3" class="btn btn-primary d-flex align-items-center gap-2"  data-bs-toggle="modal"><i class="ri-bar-chart-2-line fs-18 lh-1"></i>Customize<span class="d-none d-sm-inline"> Dashboard</span></a>
  </div>
</div>

@endsection

@section('custom_script')


@endsection
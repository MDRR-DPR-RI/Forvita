@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
    <link href="/lib/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="main main-app p-3 p-lg-4">
  <div class="container mt-3 mb-5">
       <div>
          <ol class="breadcrumb fs-sm mb-0">
            <li class="breadcrumb-item"><a href="/dashboard/{{ $share->dashboard->id }}">{{ $share->dashboard->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Publik Dashboard</li>
          </ol> <br>
          <h4 class="main-title mb-0">Publik Dashboard {{ $share->dashboard->name }}</h4>
      </div>
      <div class="mt-3">
        @if (session('status'))
            <div class="alert alert-primary mb-3">
                {{ session('status') }}
            </div>
          @endif
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              {{-- <li>Mohon Masukkan Tanggal Expired Dashboard</li> --}}
              @endforeach
            </ul>
          </div>
        @endif
      </div>
      <div class="card mt-4">
        <div class="card-body">
          <form action="/share/{{ $share->id }}" method="post">
            @method('put')
            @csrf

            <div class="setting-item">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <h6>Nama Dashboard</h6>
                        <p>Nama dashboard yang publik</p>
                    </div><!-- col -->
                    <div class="col-md">
                        <input type="text" class="form-control" placeholder="Masukkan nama Anda" value="{{ $share->dashboard->name }}" readonly>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- setting-item -->
  
            <div class="setting-item">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <h6>Nama Cluster</h6>
                        <p>Nama cluster yang publik</p>
                    </div><!-- col -->
                    <div class="col-md">
                        <input type="text" class="form-control" placeholder="Masukkan nama Anda" value="{{ $share->dashboard->cluster->name }}" readonly>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- setting-item -->
  
            <div class="setting-item">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <h6>Nama Pembuat</h6>
                        <p>Nama user yang membuat publik dashboard</p>
                    </div><!-- col -->
                    <div class="col-md">
                        <input type="text" class="form-control" placeholder="Masukkan nama Anda" value="{{ $share->user->name }}" readonly>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- setting-item -->
  
            <div class="setting-item">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <h6>Link Publik</h6>
                        <p>Harap diperhatikan agar tidak sama dengan link lain</p>
                    </div><!-- col -->
                    <div class="col-md">
                        <input type="text" class="form-control" placeholder="Masukkan nama Anda" value="{{ $share->link }}" name="link">
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- setting-item -->
  
            <div class="setting-item">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <h6>Expired Link</h6>
                        <p>Batas waktu yang dapat diakses melalui publik</p>
                    </div><!-- col -->
                    <div class="col-md">
                        <input class="flatpickr flatpickr-input form-control active" name="expired" value="{{ $share->expired }}" type="text" placeholder="Pilih tanggal dan jam" data-id="datetime">                  
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- setting-item -->

            <div class="setting-item">
                <div class="row g-2">
                    <div class="col-md-12">
                      <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">
                          Simpan
                        </button>
                      </div>
                    </div>
                </div>
            </div>   

          </form>


        </div>
      </div>
    <br>

    <br>
  </div>
</div><!-- main-app -->

@endsection

@section('custom_script')
<script src="/lib/datetime/flatpickr.js"></script>
<script>
  $(".flatpickr").flatpickr(
    {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minDate: "today",
}
  );
</script>
@endsection
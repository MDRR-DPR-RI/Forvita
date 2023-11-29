@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
<style>
  .iconpicker-dropdown ul{
    width: 500px;
    top: 80px !important;
  }
</style>
 <div class="main main-app p-3 p-lg-4">
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @elseif (session()->has('google'))
    <div class="col-xl-5 alert alert-success" role="alert">
      <h4 class="alert-heading">Login Berhasil!</h4>
      <p>Berhasil login menggunakan Google. Password Anda: <strong>{{ session('google') }}.</strong> Mohon untuk disimpan.</p>
      <hr>
      <p class="mb-0">Jika ingin mengganti password, silakan lakukan di profil Anda.</p>
    </div>
<hr>
    @elseif (session()->has('deleted'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terhapus!</strong> {{ session('deleted') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
        <div class="row g-3">
          @can ('admin')
            <div class="col-3">
              <a href="#newCluster" data-bs-toggle="modal">
                  <div class="card card-one" style="height: 200px;">
                      <div class="card card-one d-flex justify-content-center align-items-center">
                          <i class="bi bi-plus-lg" style="font-size: 6em;"></i>
                      </div>
                  </div>
              </a>
            </div>
          @endcan
@if($clusters->isEmpty())
<div class="col-xl-3 alert alert-primary d-flex align-items-center" role="alert">
  <i class="ri-information-line"></i> Belum ada cluster yang tersedia. Silakan hubungi admin untuk mengakses dashboard.
</div>
@else
    @foreach ($clusters as $cluster)
      <div class="col-3">
        <a href="/cluster/{{ $cluster->id }}">
          <div class="card card-one" style="height: 200px;">
            <div class="card-body p-3 text-center">
              <div class="d-block fs-40 lh-1 text-primary my-1 mt-3"><i class="{{ $cluster->icon_name }}"></i></div>
              <h1 class="text-dark">{{ $cluster->name }}</h1>
              @can('admin')
                <i class="mb-0 fw-medium text-dark">{{ $cluster->dashboard->count() }} Dashboard</i>
              @endcan
            <div class="row">
              <div class=" 
                {{ (Auth()->user()->role->name == "Admin") ? "d-flex justify-content-between" : "" }}
                align-items-center">
                <label class="d-block fw-medium text-dark">Dibuat oleh : {{ $cluster->user->name }}</label>  
                @can('admin')
                  <div class="d-flex">
                    <a data-id="{{ $cluster->id }}" data-name="{{ $cluster->name }}" href="#delete_cluster" class="modalDelete btn btn-danger" data-bs-toggle="modal">
                      <i data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Cluster" class="bi bi-trash3"></i>
                    </a>
                  </div>
                @endcan
              </div>
              </div>
            </div>
          </div>
        </a>
      </div>
  @endforeach
@endif

      
        </div><!-- row -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. DPR RI</span>
        </div><!-- main-footer -->
    </div><!-- main -->

@can('admin')

    {{-- MODAL NEW CLUSTER --}}
    <div class="modal fade" id="newCluster" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cluster Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/cluster" method="post">
            @csrf
            <div class="modal-body text-center">
                <label>Masukkan Nama Cluster Baru:</label>
                <input required type="text" class="form-control" name="cluster_name"><br>
              <label>Pilih Ikon</label> 
              <div class="input-group">
                <label class="iconOutput input-group-text " for="iconInput" >Ikon</label>
                <input type="text" name="icon"  class="iconInput form-control iconpickers" placeholder="Icon Picker" aria-label="Icone Picker" aria-describedby="basic-addon1" />
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Selesai</button>
            </div>
          </form>
        </div>
      </div>
    </div>
        {{-- Modal delete dashboard --}}
        <div class="modal" id="delete_cluster" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitle"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="deleteClusterMessage"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <form id="deleteClusterForm" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
            </div>
          </div>
        </div>
        </div>
    @endcan
@endsection

@push('addon-script')
<script>
(async () => {
    const response = await fetch('https://unpkg.com/codethereal-iconpicker@1.2.1/dist/iconsets/bootstrap5.json')
    const result = await response.json()

    const iconpicker = new Iconpicker(document.querySelector(".iconpickers"), {
        icons: result,
        showSelectedIn: document.querySelector(".selected-icon"),
        searchable: true,
        selectedClass: "selected",
        containerClass: "my-picker",
        hideOnSelect: true,
        fade: true,
        defaultValue: 'bi-alarm',
        valueFormat: val => `bi ${val}`
    });

    iconpicker.set() // Set as empty
    iconpicker.set('bi-alarm') // Reset with a value

    $(".iconpicker-dropdown").on("click", function() {
      $(".iconOutput").html(`<i class="${$(".iconInput").val()}" ></i>`)
    });
})()  
  
  $(document).on("click", ".modalDelete", function () {
    var cluster_id = $(this).data('id');
    var cluster_name = $(this).data('name');
    
    $("#bookId").val(cluster_id);
    
    $("#modalTitle").html(`Hapus Cluster ${cluster_name}`);
    $("#deleteClusterMessage").html(`Apakah anda ingin menghapus cluster ${cluster_name}?`);

    // Update the action attribute of the form with the cluster_id
    var formAction = "/cluster/" + cluster_id;
    
    $("#deleteClusterForm").attr("action", formAction);
  });
</script>
@endpush

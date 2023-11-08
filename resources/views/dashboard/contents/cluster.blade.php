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
        <div class="row g-3">
          @can ('admin')
            <div class="col-3">
              <a href="#newCluster" data-bs-toggle="modal">
                  <div class="card card-one" style="height: 200px;">
                      <div class="card card-one d-flex justify-content-center align-items-center">
                          <button class="btn btn-primary">+</button>
                      </div>
                  </div>
              </a>
            </div>
          @endcan
          @foreach ($clusters as $cluster)
            <div class="col-3">
              <a href="/cluster/{{ $cluster->id }}">
                <div class="card card-one">
                  <div class="card-body p-3">
                    <div class="d-block fs-40 lh-1 text-primary mb-1"><i class="{{ $cluster->icon_name }}"></i></div>
                    <h1 class="card-value mb-0 ls--1 fs-32" id="card-val">{{ $cluster->name }}</h1>
                    <label class="d-block mb-1 fw-medium text-dark">Di buat oleh : {{ $cluster->user->name }}</label>
                    <small><span class="d-inline-flex text-danger">0.7% <i class="ri-arrow-down-line"></i></span> than last week</small>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div><!-- row -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. DPR RI</span>
        </div><!-- main-footer -->
    </div><!-- main -->
    {{-- MODAL NEW CLUSTER --}}
    <div class="modal fade" id="newCluster" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Cluster</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/cluster" method="post">
        @csrf
        <div class="modal-body text-center">
            <label>Masukkan Nama Cluster Baru:</label>
            <input type="text" class="form-control" name="cluster_name">
        </div>
        <div class="modal-body text-center">
          <label>Pilih Icon</label>
          <div class="input-group mb-3">
            <label class="input-group-text iconOutput" for="iconInput" >Icon</label>
            <input type="text" name="icon"  class="iconInput form-control iconpickers" placeholder="Icon Picker" aria-label="Icone Picker" aria-describedby="basic-addon1" />
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
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

    $(".iconInput").on("blur", function() {
      $(".iconOutput").html(`<i class="${$(".iconInput").val()}" ></i>`)
    });
})()  
  
</script>
@endpush

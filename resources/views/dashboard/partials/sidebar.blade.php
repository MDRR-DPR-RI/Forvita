<style>
  .iconpicker-dropdown ul{
    width: 500px;
    top: 80px !important;
  }
</style>
  <div class="sidebar">
    <div class="sidebar-header">
      <a href="/cluster" class="sidebar-logo">SATUDATA</a>
    </div><!-- sidebar-header -->
        
    <div id="sidebarMenu" class="sidebar-body">
      <div class="nav-group show">
    @if (session()->has('cluster_id'))
        @can('admin') <!-- using gate in AppServiceProvider to show this menu only for admin-->
          <a href="#" class="nav-label">Admin</a>
          <ul class="nav nav-sidebar">
            <li class="nav-item">
                <a href="/database" class="nav-link @isset($databases) @empty($schedulers) active @endempty @endisset"><i class="ri-pie-chart-2-fill"></i> <span>Databases</span></a>
            </li>
            <li class="nav-item">
                <a href="/scheduler" class="nav-link @isset($schedulers)  active  @endisset"><i class="ri-pie-chart-2-fill"></i> <span>Queries</span></a>
            </li>
            <li class="nav-item">
              <a href="/user-management" class="nav-link @isset($initialUsers) active @endisset"><i class="ri-pie-chart-2-fill"></i> <span>Manajemen Pengguna</span></a>
            </li>
            <li class="nav-item">
              <a href="#share-list" class="nav-link" data-bs-toggle="modal"><i class="bi bi-share-fill"></i> <span>List Share Dashboard</span></a>
            </li>
          </ul>
        @endcan


        
        <a href="#" class="nav-label">Dashboard</a>
        <ul class="nav nav-sidebar">
          @can('admin')
            <li class="nav-item">
              <a href="#newDashboard" data-bs-toggle="modal" class="nav-link "><span class="btn btn-primary">Tambah Dashboard</span></a>
            </li>
          @endcan
          @foreach ($dashboards as $index_dashboard)
            <li class="nav-item">
            @if (isset($dashboard->name))
              <a href="/dashboard/{{ $index_dashboard->id }}" class="nav-link  {{ ($dashboard->id) == ($index_dashboard->id) ? 'active' : '' }}"><i class="{{ $index_dashboard->icon_name }}"></i> <span>{{ $index_dashboard->name }}</span></a>
            @else
              <a href="/dashboard/{{ $index_dashboard->id }}" class="nav-link"><i class="{{ $index_dashboard->icon_name }}"></i> <span>{{ $index_dashboard->name }}</span></a>
            @endif
            </li>
          @endforeach
        </ul>
    @endif
      </div><!-- nav-group -->
    </div><!-- sidebar-body -->


    <div class="sidebar-footer">
      <div class="sidebar-footer-top">
        <div class="sidebar-footer-thumb">
          <img src="{{ auth()->user()->getProfilePhotoURL() }}" alt="">
        </div><!-- sidebar-footer-thumb -->
        <div class="sidebar-footer-body">
          <h6><a href="../pages/profile.html">{{ auth()->user()->name }}</a></h6>
          <p>{{ auth()->user()->role->name }}</p>
        </div><!-- sidebar-footer-body -->
        <a id="sidebarFooterMenu" href="" class="dropdown-link"><i class="ri-arrow-down-s-line"></i></a>
      </div><!-- sidebar-footer-top -->
      <div class="sidebar-footer-menu">
        <nav class="nav">
          <a href="/profile"><i class="ri-profile-line"></i> View Profile</a>
        <hr>
          <a href="#modalLogout" data-bs-toggle="modal"><i class="ri-logout-box-r-line"></i> Log Out</a>
        </nav>
        <nav class="nav">
          <a style="pointer-events: none;"></a>
          <a style="pointer-events: none;"></a>
          <a style="pointer-events: none;"></a>
          <a style="pointer-events: none;"></a>
        </nav>
      </div><!-- sidebar-footer-menu -->  
    </div><!-- sidebar-footer -->
  </div><!-- sidebar -->

@can('admin')    
    {{-- MODAL NEW DASHBOARD --}}
    <div class="modal fade" id="newDashboard" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Dashboard Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/dashboard" method="post">
            @csrf
            <div class="modal-body text-center">
                <label>Masukan Nama Dashboard:</label>
                <input type="text" class="form-control" name="dashboard_name" placeholder="Nama dashboard" autofocus required>
            </div> 
          <div class="modal-body text-center">
              <label>Masukan Deskripsi Dashboard:</label>
              <textarea class="form-control" name="dashboard_description" rows="3" placeholder="Deskripsi dashboard..." required></textarea>
            </div>
            <div class="modal-body text-center">
            <label>Pilih Icon</label>
              <div class="input-group mb-3">
                <label class="iconOutputs input-group-text" for="iconInputs">Icon</label>
                <input type="text" name="icon"  class="iconInputs form-control iconpicker" placeholder="Icon Picker" aria-label="Icone Picker" aria-describedby="basic-addon1" required/>
              </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah Dashboard</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  {{-- Modal Share--}}
  <div class="modal fade" id="share-list" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">List Publik Dashboard </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div><!-- modal-header -->
        <div class="modal-body container ">
          <div class="row">
            <div class="col-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID Dashboard</th>
                    <th scope="col">Nama Dashboard</th>
                    <th scope="col">Nama Pembuat</th>
                    <th scope="col">Link</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($shares as $key => $share)
                  <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $share->dashboard_id }}</td>
                    <td>{{ $share->dashboard->name }}</td>
                    <td>{{ $share->user->name }}</td>
                    <td>https://172.18.25.16/public/dashboard/{{ $share->link }}</td>
                    <td>
                      <form action="/share/{{ $share->id }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      
        </div> <!-- modal-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div><!-- modal-footer -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal-fade -->

@endcan


@push('addon-script')
<script>
 (async () => {
    const response = await fetch('https://unpkg.com/codethereal-iconpicker@1.2.1/dist/iconsets/bootstrap5.json')
    const result = await response.json()

    const iconpicker = new Iconpicker(document.querySelector(".iconpicker"), {
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
      $(".iconOutputs").html(`<i class="${$(".iconInputs").val()}" ></i>`)
    });


})()

</script>    
@endpush

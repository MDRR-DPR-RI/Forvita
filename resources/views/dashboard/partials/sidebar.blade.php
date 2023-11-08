
  <div class="sidebar">
    <div class="sidebar-header">
      <a href="/cluster" class="sidebar-logo">SATU DATA</a>
    </div><!-- sidebar-header -->
        
    <div id="sidebarMenu" class="sidebar-body">
      <div class="nav-group show">
    @if (session()->has('cluster_id'))
        @can('admin') <!-- using gate in AppServiceProvider to show this menu only for admin-->
          <a href="#" class="nav-label">Admin</a>
          <ul class="nav nav-sidebar">
            <li class="nav-item">
                <a href="/database" class="nav-link @isset($databases) @empty($schedulers) active @endempty @endisset"><i class="ri-pie-chart-2-fill"></i> <span>databases</span></a>
            </li>
            <li class="nav-item">
                <a href="/scheduler" class="nav-link @isset($schedulers)  active  @endisset"><i class="ri-pie-chart-2-fill"></i> <span>scheduler</span></a>
            </li>
            <li class="nav-item">
              <a href="/user-management" class="nav-link @isset($initialUsers) active @endisset"><i class="ri-pie-chart-2-fill"></i> <span>User Management</span></a>
            </li>
          </ul>
        @endcan


        
        <a href="#" class="nav-label">Dashboard</a>
        <ul class="nav nav-sidebar">
          @can('admin')
            <li class="nav-item">
              <a href="#newDashboard" data-bs-toggle="modal" class="nav-link "><span class="btn btn-primary">New Dashboard</span></a>
            </li>
          @endcan
          @foreach ($dashboards as $index_dashboard)
            <li class="nav-item">
            @if (isset($dashboard->name))
              <a href="/dashboard/{{ $index_dashboard->id }}" class="nav-link  {{ ($dashboard->name) == ($index_dashboard->name) ? 'active' : '' }}"><i class="{{ $dashboard->icon_name }}"></i> <span>{{ $index_dashboard->name }}</span></a>
            @else
              <a href="/dashboard/{{ $index_dashboard->id }}" class="nav-link"><i class="{{ $dashboard->icon_name }}"></i> <span>{{ $index_dashboard->name }}</span></a>
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
          <img src="/img/img1.jpg" alt="">
        </div><!-- sidebar-footer-thumb -->
        <div class="sidebar-footer-body">
          <h6><a href="../pages/profile.html">{{ auth()->user()->name }}</a></h6>
          <p>{{ auth()->user()->role->name }}</p>
        </div><!-- sidebar-footer-body -->
        <a id="sidebarFooterMenu" href="" class="dropdown-link"><i class="ri-arrow-down-s-line"></i></a>
      </div><!-- sidebar-footer-top -->
      <div class="sidebar-footer-menu">
        <nav class="nav">
          <a href=""><i class="ri-profile-line"></i> View Profile</a>
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
            <input type="text" class="form-control" name="dashboard_name" placeholder="Nama dashboard" autofocus>
        </div> 
       <div class="modal-body text-center">
          <label>Masukan Deskripsi Dashboard:</label>
          <textarea class="form-control" name="dashboard_description" rows="3" placeholder="Deskripsi dashboard..."></textarea>
        </div>
        <div class="modal-body text-center">
            <label>Pilih Icon:</label>
            <input type="text" class="form-control iconpicker" name="icon" placeholder="Icon Picker" aria-label="Icone Picker" aria-describedby="basic-addon1" />
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah Dashboard</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
})()

</script>    
@endpush
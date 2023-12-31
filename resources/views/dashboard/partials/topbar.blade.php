
  <div class="header-main px-3 px-lg-4">
    <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>
{{-- if in cluster.blade (no cluster_name stored in session) --}}
@if (null === session('cluster_name')) 
    <div class="form-search me-auto">
    {{-- <div class="me-auto"> --}}
      <input type="text" id="searchInput" class="form-control" placeholder="Search">
      <i class="ri-search-line"></i>
    </div><!-- form-search -->
@else 
    <div class="me-auto">
    </div><!-- form-search -->
@endif

    <div class="dropdown dropdown-skin">
      <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i class="ri-settings-3-line"></i></a>
      <div class="dropdown-menu dropdown-menu-end mt-10-f">
        <label>Tema</label>
        <nav id="skinMode" class="nav nav-skin">
          <a href="" class="nav-link active">Prime</a>
          <a href="" class="nav-link">Dark</a>
        </nav>
        <hr>
        <label>Menu</label>
        <nav id="sidebarSkin" class="nav nav-skin">
          <a href="" class="nav-link active">Default</a>
          <a href="" class="nav-link">Prime</a>
          <a href="" class="nav-link">Dark</a>
        </nav>
      </div><!-- dropdown-menu -->
    </div><!-- dropdown -->

    <div class="dropdown dropdown-profile ms-3 ms-xl-4">
      <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">
        <div class="avatar online"><img src="{{ auth()->user()->getProfilePhotoURL() }}" alt=""></div>
      </a>
      <div class="dropdown-menu dropdown-menu-end mt-10-f">
        <div class="dropdown-menu-body">
          <div class="avatar avatar-xl online mb-3"><img src="{{ auth()->user()->getProfilePhotoURL() }}" alt=""></div>
          <h5 class="mb-1 text-dark fw-semibold">{{ auth()->user()->name }}</h5>
          <p>{{ auth()->user()->role->name }}</p>
          <nav class="nav">
            <a href="/profile"><i class="ri-profile-line"></i>Lihat Profil</a>
          </nav>
          <hr>
          <nav class="nav">
            <a href="#modalLogout" data-bs-toggle="modal"><i class="ri-logout-box-r-line"></i>Keluar</a>
          </nav>
        </div><!-- dropdown-menu-body -->
      </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
  </div><!-- header-main -->

<!-- Modal LOG-OUT -->
<div class="modal" id="modalLogout" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Keluar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Yakin Ingin Keluar?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="btn btn-primary">Keluar</button>
        </form>
      </div>
    </div>
  </div>
</div>


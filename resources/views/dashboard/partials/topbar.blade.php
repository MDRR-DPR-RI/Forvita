
  <div class="header-main px-3 px-lg-4">
    <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>

    <div class="form-search me-auto">
      <input type="text" class="form-control" placeholder="Search">
      <i class="ri-search-line"></i>
    </div><!-- form-search -->


    <div class="dropdown dropdown-skin">
      <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i class="ri-settings-3-line"></i></a>
      <div class="dropdown-menu dropdown-menu-end mt-10-f">
        <label>Tema</label>
        <nav id="skinMode" class="nav nav-skin">
          <a href="" class="nav-link active">Terang</a>
          <a href="" class="nav-link">Gelap</a>
        </nav>
        <hr>
        <label>Menu</label>
        <nav id="sidebarSkin" class="nav nav-skin">
          <a href="" class="nav-link active">Standar</a>
          <a href="" class="nav-link">Terang</a>
          <a href="" class="nav-link">Gelap</a>
        </nav>
        {{-- <hr>
        <label>Direction</label>
        <nav id="layoutDirection" class="nav nav-skin">
          <a href="" class="nav-link active">LTR</a>
          <a href="" class="nav-link">RTL</a>
        </nav> --}}
      </div><!-- dropdown-menu -->
    </div><!-- dropdown -->

    <div class="dropdown dropdown-profile ms-3 ms-xl-4">
      <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">
        <div class="avatar online"><img src="/img/img1.jpg" alt=""></div>
      </a>
      <div class="dropdown-menu dropdown-menu-end mt-10-f">
        <div class="dropdown-menu-body">
          <div class="avatar avatar-xl online mb-3"><img src="/img/img1.jpg" alt=""></div>
          <h5 class="mb-1 text-dark fw-semibold">{{ auth()->user()->name }}</h5>
          <p>{{ auth()->user()->role->name }}</p>
          <nav class="nav">
            <a href="/view-profile"><i class="ri-profile-line"></i>Lihat Profil</a>
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


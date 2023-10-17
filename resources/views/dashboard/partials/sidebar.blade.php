
  <div class="sidebar">
    <div class="sidebar-header">
      <a href="../" class="sidebar-logo">SATU DATA</a>
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
      <div class="nav-group show">
        <a href="#" class="nav-label">Admin</a>
        <ul class="nav nav-sidebar">
          <li class="nav-item">
              <a href="/scheduler" class="nav-link @isset($schedulers) active @endisset"><i class="ri-pie-chart-2-fill"></i> <span>scheduler</span></a>
          </li>
        </ul>
        <a href="#" class="nav-label">Dashboard</a>
        <ul class="nav nav-sidebar">
          @foreach ($dashboards as $dashboard)
            <li class="nav-item">
              @if(isset($dashboard_name))
                <a href="/{{ $dashboard->id }}" class="nav-link {{ ($dashboard_name) == ($dashboard->name) ? 'active' : '' }}"><i class="ri-pie-chart-2-fill"></i> <span>{{ $dashboard->name }}</span></a>
              @else
                <a href="/{{ $dashboard->id }}" class="nav-link"><i class="ri-pie-chart-2-fill"></i> <span>{{ $dashboard->name }}</span></a>
              @endif
            </li>
          @endforeach
          {{-- <li class="nav-item">
            <a href="/kelompok23" class="nav-link {{ ($dashboard) == "kelompok23" ? 'active' : '' }}"><i class="ri-calendar-todo-line"></i> <span>Kelompok 2 & 3</span></a>
          </li>
          <li class="nav-item">
            <a href="/kelompok46" class="nav-link {{ ($dashboard) == "kelompok46" ? 'active' : '' }}"><i class="ri-shopping-bag-3-line"></i> <span>Kelompok 4 & 6</span></a>
          </li>
          <li class="nav-item">
            <a href="/kelompok5" class="nav-link {{ ($dashboard) == "kelompok5" ? 'active' : '' }}"><i class="ri-bar-chart-2-line"></i> <span>Kelompok 5</span></a>
          </li> --}}
        </ul>
      </div><!-- nav-group -->
      
      
    </div><!-- sidebar-body -->
    <div class="sidebar-footer">
      <div class="sidebar-footer-top">
        <div class="sidebar-footer-thumb">
          <img src="/img/img1.jpg" alt="">
        </div><!-- sidebar-footer-thumb -->
        <div class="sidebar-footer-body">
          <h6><a href="../pages/profile.html">Shaira Diaz</a></h6>
          <p>Premium Member</p>
        </div><!-- sidebar-footer-body -->
        <a id="sidebarFooterMenu" href="" class="dropdown-link"><i class="ri-arrow-down-s-line"></i></a>
      </div><!-- sidebar-footer-top -->
      <div class="sidebar-footer-menu">
        <nav class="nav">
          <a href=""><i class="ri-edit-2-line"></i> Edit Profile</a>
          <a href=""><i class="ri-profile-line"></i> View Profile</a>
        </nav>
        <hr>
        <nav class="nav">
          <a href=""><i class="ri-question-line"></i> Help Center</a>
          <a href=""><i class="ri-lock-line"></i> Privacy Settings</a>
          <a href=""><i class="ri-user-settings-line"></i> Account Settings</a>
          <a href=""><i class="ri-logout-box-r-line"></i> Log Out</a>
        </nav>
      </div><!-- sidebar-footer-menu -->
    </div><!-- sidebar-footer -->
  </div><!-- sidebar -->
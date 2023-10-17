
  <div class="sidebar">
    <div class="sidebar-header">
      <a href="/cluster" class="sidebar-logo">SATU DATA</a>
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
      <div class="nav-group show">
        <a href="#" class="nav-label">Dashboard</a>
        <ul class="nav nav-sidebar">
          <li class="nav-item">
            <a href="#newDashboard" data-bs-toggle="modal" class="nav-link "><span class="btn btn-primary">New Dashboard</span></a>
          </li>
          @foreach ($dashboards as $dashboard)
            <li class="nav-item">
              <a href="/dashboard/control/{{ $dashboard->id }}?dashboard_id={{ $dashboard->id }}&cluster_id={{ $dashboard->cluster_id }}" class="nav-link {{ ($dashboard_name) == ($dashboard->name) ? 'active' : '' }}"><i class="ri-pie-chart-2-fill"></i> <span>{{ $dashboard->name }}</span></a>
            </li>
          @endforeach
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
    
    {{-- MODAL NEW DASHBOARD --}}
    <div class="modal fade" id="newDashboard" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Dashboard</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/dashboard" method="post">
        @csrf
        <div class="modal-body text-center">
            <label>Enter New Dashboard Name:</label>
            <input type="text" class="form-control" name="dashboard_name">
            <input type="text" class="form-control" name="cluster_id" value="{{ $dashboard->cluster_id }}">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Dashboard</button>
        </div>
      </form>
    </div>
  </div>
</div>

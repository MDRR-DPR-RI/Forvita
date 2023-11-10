// HERE IS WHERE U PUT UR HTML CONTENT. THEN ADD NEW CHART IN DATABASE (table->charts)
let htmlStructures = {
  1: [`<div class="col-xl-" id="content">
        </div>`],
  2: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="description"></div><!-- card-description -->
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  3: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="description"></div><!-- card-description -->
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  4: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="description"></div><!-- card-description -->
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`,],
  5: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="description"></div><!-- card-description -->
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  6: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="description"></div><!-- card-description -->
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  7: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="description"></div><!-- card-description -->
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  8: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header" >
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
                  <div class="row g-4">
                <div class="col-md-6">
                  <div id="description"></div><!-- card-description -->
                  <div id="content" class="apex-chart-three"></div>
                </div><!-- col -->
                <div class="col-md-6">
                  <div class="d-flex">
                    <div>
                      <h6 class="fw-semibold text-dark mb-1">AI Analysis</h6>
                      <p class="fs-sm text-secondary mb-0" id="aiAnalysis">
                        <p class="card-text placeholder-glow" id="placeholder">
                          <span class="placeholder col-12">.............................................................</span>
                          <span class="placeholder col-18">.............................................................</span>
                        </p>
                      </p>
                    </div><!-- div -->
                  </div><!-- d-flex -->
                  <div>
                     <a href="#modalprompt" class="btn btn-primary" data-bs-toggle="modal" data-content-id="id">Edit Prompt</a>
                  </div>
                </div><!-- col -->
              </div><!-- row -->
            </div><!-- card-body -->
            
          </div><!-- card -->
        </div><!-- col -->`],
  9: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="description"></div><!-- card-description -->
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  10: [`<div class="col-xl-">
    <div class="card card-one">
      <div class="card-header">
        <div id="judul"></div><!-- card-title -->
        <nav class="nav nav-icon nav-icon-sm ms-auto">
          <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
          <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
        </nav>
      </div><!-- card-header -->
      <div class="card-body p-4">
        <div id="description"></div><!-- card-description -->
        <div id="content"></div>
      </div><!-- card-body -->
        </div><!-- card -->
        </div><!-- col -->`],
  11: [`<div class="col-xl-" >
          <div class="row g-3" id="content">
          </div>
        </div>`],
  12: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div id="description"></div><!-- card-description -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Jumlah</th>
                </tr>
                <tbody id="content">
                </tbody>
              </thead>
            </table>
          </div>
        </div>`],
  13: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="description"></div><!-- card-description -->
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  14: [`<div class="col-xl-">
        <div class="card card-one">
          <div class="card-header">
            <div id="judul"></div><!-- card-title -->
            <nav class="nav nav-icon nav-icon-sm ms-auto">
              <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
              <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
            </nav>
          </div><!-- card-header -->
          <div class="card-body p-4">
            <div id="description"></div><!-- card-description -->
            <div id="content"></div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div><!-- col -->`],
  15: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-3 p-xl-4">
              <div id="description"></div><!-- card-description -->
              <div class="row justify-content-center g-3 mb-2 mb-xl-4" id="content"></div><!-- content -->
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  16: [`<div class="col-xl-">
    <div class="card card-one">
      <div class="card-header">
        <div id="judul"></div><!-- card-title -->
        <nav class="nav nav-icon nav-icon-sm ms-auto">
          <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
          <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
        </nav>
      </div><!-- card-header -->
      <div class="card-body p-3 p-xl-4">
        <div id="description"></div><!-- card-description -->
        <div class="ht-300" id="content"></div><!-- content -->
      </div><!-- card-body -->
    </div><!-- card -->
  </div><!-- col -->`]
};
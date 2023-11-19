// HERE IS WHERE U PUT UR HTML CONTENT. THEN ADD NEW CHART IN DATABASE (table->charts)
let htmlStructures = {
  1: [`<div class="col-xl-">
        <div class="card card-one">
          <div class="card-header">
            <div id="judul"></div><!-- card-title -->
          </div><!-- card-header -->
          <div class="card-body p-4">
            <div id="description"></div><!-- card-description -->
            <div id="content"></div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div><!-- col -->`,],
  2: [`<div class="col-xl-">
        <div class="card card-one">
          <div class="card-header">
            <div id="judul"></div><!-- card-title -->
          </div><!-- card-header -->
          <div class="card-body p-4">
            <div id="description"></div><!-- card-description -->
            <div id="content"></div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div><!-- col -->`,],
  3: [`<div class="col-xl-">
        <div class="card card-one">
          <div class="card-header">
            <div id="judul"></div><!-- card-title -->
          </div><!-- card-header -->
          <div class="card-body p-4">
            <div id="description"></div><!-- card-description -->
            <div id="content"></div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div><!-- col -->`,],
  4: [`<div class="col-xl-">
        <div class="card card-one">
          <div class="card-header">
            <div id="judul"></div><!-- card-title -->
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
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  6: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  7: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  8: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  9: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  10: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  11: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  12: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  13: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  14: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  15: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  16: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  17: [`<div class="col-xl-">
      <div class="card card-one">
        <div class="card-header">
          <div id="judul"></div><!-- card-title -->
        </div><!-- card-header -->
        <div class="card-body p-4">
          <div id="description"></div><!-- card-description -->
          <div id="content"></div>
        </div><!-- card-body -->
      </div><!-- card -->
    </div><!-- col -->`,],
  18: [`<div class="col-xl-" id="content">
        </div>`],
  19: [`<div class="col-xl-">
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
  </div><!-- col -->`],
  20: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header" >
              <div id="judul"></div><!-- card-title -->
            </div><!-- card-header -->
            <div class="card-body p-4">
                <div class="col-md-6">
                  <div class="d-flex">
                    <div>
                      <p class="fs-sm text-secondary mb-0" id="aiAnalysis">
                        <p class="card-text placeholder-glow" id="placeholder">
                          <span class="placeholder col-12">.............................................................</span>
                          <span class="placeholder col-18">.............................................................</span>
                        </p>
                      </p>
                    </div><!-- div -->
                  </div><!-- d-flex -->
                </div><!-- col -->
            </div><!-- card-body -->
            
          </div><!-- card -->
        </div><!-- col -->`],
    21: [`<div class="col-xl-" >
          <div class="row g-3" id="content">
          </div>
        </div>`],
    22: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
            </div><!-- card-header -->
            <div class="card-body p-3 p-xl-4">
              <div id="description"></div><!-- card-description -->
              <table class="table table-hover" id="contentTable">
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
                </div><!-- card-body -->
          </div>
        </div>`],
    23: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
            </div><!-- card-header -->
            <div class="card-body p-3 p-xl-4">
              <div id="description"></div><!-- card-description -->
              <div class="row justify-content-center g-3 mb-2 mb-xl-4" id="content"></div><!-- content -->
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
    24: [`<div class="col-xl-">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="description"></div><!-- card-description -->
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  // 2: [`<div class="col-xl-">
  //         <div class="card card-one">
  //           <div class="card-header">
  //             <div id="judul"></div><!-- card-title -->
  //           </div><!-- card-header -->
  //           <div class="card-body p-4">
  //             <div id="description"></div><!-- card-description -->
  //             <div id="content"></div>
  //           </div><!-- card-body -->
  //         </div><!-- card -->
  //       </div><!-- col -->`],
  // 3: [`<div class="col-xl-">
  //         <div class="card card-one">
  //           <div class="card-header">
  //             <div id="judul"></div><!-- card-title -->
  //           </div><!-- card-header -->
  //           <div class="card-body p-4">
  //             <div id="description"></div><!-- card-description -->
  //             <div id="content"></div>
  //           </div><!-- card-body -->
  //         </div><!-- card -->
  //       </div><!-- col -->`],
  // 5: [`<div class="col-xl-">
  //         <div class="card card-one">
  //           <div class="card-header">
  //             <div id="judul"></div><!-- card-title -->
  //           </div><!-- card-header -->
  //           <div class="card-body p-4">
  //             <div id="description"></div><!-- card-description -->
  //             <div id="content"></div>
  //           </div><!-- card-body -->
  //         </div><!-- card -->
  //       </div><!-- col -->`],

  // 7: [`<div class="col-xl-">
  //         <div class="card card-one">
  //           <div class="card-header">
  //             <div id="judul"></div><!-- card-title -->
  //           </div><!-- card-header -->
  //           <div class="card-body p-4">
  //             <div id="description"></div><!-- card-description -->
  //             <div id="content"></div>
  //           </div><!-- card-body -->
  //         </div><!-- card -->
  //       </div><!-- col -->`],
 
  // 9: [`<div class="col-xl-">
  //         <div class="card card-one">
  //           <div class="card-header">
  //             <div id="judul"></div><!-- card-title -->
  //           </div><!-- card-header -->
  //           <div class="card-body p-4">
  //             <div id="description"></div><!-- card-description -->
  //             <div id="content"></div>
  //           </div><!-- card-body -->
  //         </div><!-- card -->
  //       </div><!-- col -->`],
  // 10: [`<div class="col-xl-">
  //   <div class="card card-one">
  //     <div class="card-header">
  //       <div id="judul"></div><!-- card-title -->
  //       <nav class="nav nav-icon nav-icon-sm ms-auto">
  //         <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
  //         <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
  //       </nav>
  //     </div><!-- card-header -->
  //     <div class="card-body p-4">
  //       <div id="description"></div><!-- card-description -->
  //       <div id="content"></div>
  //     </div><!-- card-body -->
  //       </div><!-- card -->
  //       </div><!-- col -->`],
 
 
  // 13: [`<div class="col-xl-">
  //         <div class="card card-one">
  //           <div class="card-header">
  //             <div id="judul"></div><!-- card-title -->
  //           </div><!-- card-header -->
  //           <div class="card-body p-4">
  //             <div id="description"></div><!-- card-description -->
  //             <div id="content"></div>
  //           </div><!-- card-body -->
  //         </div><!-- card -->
  //       </div><!-- col -->`],
  // 14: [`<div class="col-xl-">
  //       <div class="card card-one">
  //         <div class="card-header">
  //           <div id="judul"></div><!-- card-title -->
  //           <nav class="nav nav-icon nav-icon-sm ms-auto">
  //             <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
  //             <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
  //           </nav>
  //         </div><!-- card-header -->
  //         <div class="card-body p-4">
  //           <div id="description"></div><!-- card-description -->
  //           <div id="content"></div>
  //         </div><!-- card-body -->
  //       </div><!-- card -->
  //     </div><!-- col -->`],
 

};
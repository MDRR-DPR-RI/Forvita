// HERE IS WHERE U PUT UR HTML CONTENT. THEN ADD NEW CHART IN DATABASE (table->charts)
let htmlStructures = {
  1: [`<div class="col-xl-9">
          <div class="card card-one">
            <div class="card-body overflow-hidden px-0 pb-3">
              <div class="finance-info p-3 p-xl-4">
                <label class="fs-sm fw-medium mb-2 mb-xl-1">Profit This Year</label>
                <h1 class="finance-value"><span>$</span>867,036.50 <span>USD</span></h1>

                <h4 class="finance-subvalue mb-3 mb-md-2">
                  <i class="ri-arrow-up-line text-primary"></i>
                  <span class="text-primary">38.63%</span>
                  <small>vs last year</small>
                </h4>

                <p class="w-50 fs-sm mb-2 mb-xl-4 d-none d-sm-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...</p>

                <div class="row row-cols-auto g-3 g-xl-4 pt-2">
                  <div class="col">
                    <h6 class="card-value fs-15 mb-1">$30,342.15 USD</h6>
                    <span class="fs-sm fw-medium text-secondary d-block mb-1">First Quarter</span>
                    <span class="text-success fs-xs d-flex align-items-center ff-numerals">2.3% <i class="ri-arrow-up-line fs-15 lh-3"></i></span>
                  </div><!-- col -->
                  <div class="col">
                    <h6 class="card-value fs-15 mb-1">$48,036.90 USD</h6>
                    <span class="fs-sm fw-medium text-secondary d-block mb-1">Second Quarter</span>
                    <span class="text-success fs-xs d-flex align-items-center ff-numerals">6.8% <i class="ri-arrow-up-line fs-15 lh-3"></i></span>
                  </div><!-- col -->
                  <div class="col">
                    <h6 class="card-value fs-15 mb-1">$68,156.00 USD</h6>
                    <span class="fs-sm fw-medium text-secondary d-block mb-1">Third Quarter</span>
                    <span class="text-success fs-xs d-flex align-items-center ff-numerals">10.5% <i class="ri-arrow-up-line fs-15 lh-3"></i></span>
                  </div><!-- col -->
                  <div class="col">
                    <h6 class="card-value fs-15 mb-1">$64,896.65 USD</h6>
                    <span class="fs-sm fw-medium text-secondary d-block mb-1">Fourth Quarter</span>
                    <span class="text-danger fs-xs d-flex align-items-center ff-numerals">0.8% <i class="ri-arrow-down-line fs-15 lh-3"></i></span>
                  </div><!-- col -->
                </div><!-- row -->

              </div>

              <nav class="nav nav-finance-one p-3 p-xl-4">
                <a href="" class="active">2023</a>
                <a href="">2022</a>
                <a href="">2021</a>
              </nav>

              <div id="apexChart1" class="apex-chart-two"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  2: [`<div class="col-xl-3">
          <div class="row g-3">
            <div class="col-sm-6 col-xl-12">
              <div class="card card-one">
                <div class="card-body overflow-hidden">
                  <h2 class="card-value mb-1">75<span>%</span></h2>
                  <h6 class="text-dark fw-semibold mb-1">Gross Profit Margin</h6>
                  <p class="fs-xs text-secondary mb-0 lh-4">The gross profit you make on each dollar of sales.</p>
                  <div id="apexChart2" class="apex-chart-three"></div>
                </div>
              </div><!-- card -->
            </div><!-- col -->
            <div class="col-sm-6 col-xl-12">
              <div class="card card-one">
                <div class="card-body">
                  <h2 class="card-value mb-1">68<span>%</span></h2>
                  <h6 class="text-dark fw-semibold mb-1">Net Profit Margin</h6>
                  <p class="fs-xs text-secondary mb-0 lh-4">Measures your business at generating profit sales.</p>
                  <div id="apexChart3" class="apex-chart-three"></div>
                </div>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- col -->`],
  3: [`<div class="col-xl-6">
          <div class="card card-one">
            <div class="card-header border-0 pb-2">
              <h6 class="card-title">Profit Margin (%)</h6>
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body pt-0">
              <p class="fs-sm text-secondary mb-4">Profit margin is a measure of profitability. It is calculated by finding the profit as a percentage of the revenue.</p>

              <div class="progress progress-finance mb-4">
                <div class="progress-bar w-30" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">29.7%</div>
                <div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">52.8%</div>
                <div class="progress-bar w-20" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">18.3%</div>
              </div>

              <div class="row g-3">
                <div class="col">
                  <label class="card-label fs-sm fw-medium mb-1">Gross Profit</label>
                  <h2 class="card-value mb-0">29.7%</h2>
                </div><!-- col -->
                <div class="col-5 col-sm">
                  <label class="card-label fs-sm fw-medium mb-1">Operating Profit</label>
                  <h2 class="card-value mb-0">52.8%</h2>
                </div><!-- col -->
                <div class="col">
                  <label class="card-label fs-sm fw-medium mb-1">Net Profit</label>
                  <h2 class="card-value mb-0">18.3%</h2>
                </div><!-- col -->
              </div><!-- row -->
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->` ,],
  4: [`<div class="col-xl-6">
          <div class="card card-one">
            <div class="card-body">
              <div id="content" class="mb-1"></div>
              <h3 class="card-value">0.9:8</h3>
              <div class="progress ht-5 mb-2">
                <div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <label class="fw-semibold text-dark mb-1">Quick Ratio Goal: 1.0 or higher</label>
              <p class="fs-sm text-secondary mb-0">Measures your Accounts Receivable / Current Liabilities</p>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  5: [`<div class="col-xl-12">
          <div class="card card-one">
            <div class="card-body p-3 p-xl-4">
              <div class="row justify-content-center g-3 mb-2 mb-xl-4">
                <div class="col-6 col-sm-4 col-md">
                  <div class="finance-item">
                    <div class="finance-item-circle">
                      <h1>4.7B</h1>
                      <label>Total Income</label>
                    </div><!-- finance-item-circle -->
                  </div><!-- finance-item -->
                </div><!-- col -->
                <div class="col-6 col-sm-4 col-md">
                  <div class="finance-item">
                    <div class="finance-item-circle">
                      <h1>60M</h1>
                      <label>Total Expenses</label>
                    </div><!-- finance-item-circle -->
                  </div><!-- finance-item -->
                </div><!-- col -->
                <div class="col-6 col-sm-4 col-md">
                  <div class="finance-item">
                    <div class="finance-item-circle bg-gray-400">
                      <h1>2.1B</h1>
                      <label>Net Profit</label>
                    </div><!-- finance-item-circle -->
                  </div><!-- finance-item -->
                </div><!-- col -->
                <div class="col-6 col-sm-4 col-md">
                  <div class="finance-item">
                    <div class="finance-item-circle">
                      <h1>18.2%</h1>
                      <label>Quick Ratio</label>
                    </div><!-- finance-item-circle -->
                  </div><!-- finance-item -->
                </div><!-- col -->
                <div class="col-6 col-sm-4 col-md">
                  <div class="finance-item">
                    <div class="finance-item-circle">
                      <h1>6.8%</h1>
                      <label>Current Ratio</label>
                    </div><!-- finance-item-circle -->
                  </div><!-- finance-item -->
                </div><!-- col -->
              </div><!-- row -->

              <div class="row g-4 g-lg-5 pt-3">
                <div class="col-sm-6 col-xl-3">
                  <div class="d-flex">
                    <i class="ri-wallet-2-line fs-32 lh-1 me-3"></i>
                    <div>
                      <h6 class="fw-semibold text-dark mb-2">Accounts Receivable</h6>
                      <p class="fs-sm text-secondary mb-0">The proceeds or payment which the company will receive from its customers.</p>
                    </div>
                  </div>
                </div><!-- col -->
                <div class="col-sm-6 col-xl-3">
                  <div class="d-flex">
                    <i class="ri-refund-2-line fs-32 lh-1 me-3"></i>
                    <div>
                      <h6 class="fw-semibold text-dark mb-2">Accounts Payable</h6>
                      <p class="fs-sm text-secondary mb-0">Money owed by a business to its suppliers shown as a liability.</p>
                    </div>
                  </div>
                </div><!-- col -->
                <div class="col-sm-6 col-xl-3">
                  <div class="d-flex">
                    <i class="ri-exchange-line fs-32 lh-1 me-3"></i>
                    <div>
                      <h6 class="fw-semibold text-dark mb-2">Quick Ratio</h6>
                      <p class="fs-sm text-secondary mb-0">Measures the ability of a company to use its near cash or quick assets.</p>
                    </div>
                  </div>
                </div><!-- col -->
                <div class="col-sm-6 col-xl-3">
                  <div class="d-flex">
                    <i class="ri-exchange-dollar-line fs-32 lh-1 me-3"></i>
                    <div>
                      <h6 class="fw-semibold text-dark mb-2">Current Ratio</h6>
                      <p class="fs-sm text-secondary mb-0">Measures whether a firm has enough resources to meet its short-term obligations.</p>
                    </div>
                  </div>
                </div><!-- col -->
              </div><!-- row -->
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  6: [`<div class="col-xl-6">
          <div class="card card-one">
            <div class="card-body">
              <div id="apexChart5" class="mb-1"></div>
              <h3 class="card-value">2.8:0</h3>
              <div class="progress ht-5 mb-2">
                <div class="progress-bar bg-ui-02 w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <label class="fw-semibold text-dark mb-1">Quick Ratio Goal: 2.0 or higher</label>
              <p class="fs-sm text-secondary mb-0">Measures your Current Assets / Current Liabilities</p>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  7: [` <div class="col-xl-4">
          <div class="card card-one">
            <div class="card-header">
              <h6 class="card-title">Pengusul RUU</h6>
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body position-relative d-flex justify-content-center">
              <div id="chartDonut" class="apex-donut-two"></div>
              <div class="finance-donut-value "style="margin-bottom: 35px;">
                 <!--<h1>200</h1>-->
                 <!--<p>86.24%</p>-->
              </div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col --> `],
  8: [`<div class="col-xl-8">
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
  9: [`<div class="col-xl-8">
          <div class="card card-one">
            <div class="card-body p-4">
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  10: [`<div class="col-xl-4">
    <div class="card card-one">
      <div class="card-header">
        <div id="judul"></div><!-- card-title -->
        <nav class="nav nav-icon nav-icon-sm ms-auto">
          <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
          <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
        </nav>
      </div><!-- card-header -->
      <div class="card-body p-4">
        <div id="content"></div>
      </div><!-- card-body -->
        </div><!-- card -->
        </div><!-- col -->`],
  11: [`<div class="col-xl-8" >
          <div class="row g-3" id="content">
          </div>
        </div>`],
  12: [`<div class="col-xl-8 " >
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Jumlah</th>
                </tr>
                <tbody id="content">
                </tbody>
              </thead>
            </table>
          </div>
        </div>`],
  13: [`<div class="col-xl-8">
          <div class="card card-one">
            <div class="card-header">
              <div id="judul"></div><!-- card-title -->
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div id="content"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`],
  14: [`<div class="col-xl-4">
        <div class="card card-one">
          <div class="card-header">
            <div id="judul"></div><!-- card-title -->
            <nav class="nav nav-icon nav-icon-sm ms-auto">
              <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
              <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
            </nav>
          </div><!-- card-header -->
          <div class="card-body p-4">
            <div id="content"></div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div><!-- col -->`],
  15: [`<div class="col-xl-12">
          <div class="card card-one">
            <div class="card-body p-3 p-xl-4">
              <div class="row justify-content-center g-3 mb-2 mb-xl-4" id="content">
              </div><!-- row -->
              <div class="row g-4 g-lg-5 pt-3">
                <div class="col-sm-6 col-xl-3">
                  <div class="d-flex">
                    <i class="ri-wallet-2-line fs-32 lh-1 me-3"></i>
                    <div>
                      <h6 class="fw-semibold text-dark mb-2">Accounts Receivable</h6>
                      <p class="fs-sm text-secondary mb-0">The proceeds or payment which the company will receive from its customers.</p>
                    </div>
                  </div>
                </div><!-- col -->
                <div class="col-sm-6 col-xl-3">
                  <div class="d-flex">
                    <i class="ri-refund-2-line fs-32 lh-1 me-3"></i>
                    <div>
                      <h6 class="fw-semibold text-dark mb-2">Accounts Payable</h6>
                      <p class="fs-sm text-secondary mb-0">Money owed by a business to its suppliers shown as a liability.</p>
                    </div>
                  </div>
                </div><!-- col -->
                <div class="col-sm-6 col-xl-3">
                  <div class="d-flex">
                    <i class="ri-exchange-line fs-32 lh-1 me-3"></i>
                    <div>
                      <h6 class="fw-semibold text-dark mb-2">Quick Ratio</h6>
                      <p class="fs-sm text-secondary mb-0">Measures the ability of a company to use its near cash or quick assets.</p>
                    </div>
                  </div>
                </div><!-- col -->
                <div class="col-sm-6 col-xl-3">
                  <div class="d-flex">
                    <i class="ri-exchange-dollar-line fs-32 lh-1 me-3"></i>
                    <div>
                      <h6 class="fw-semibold text-dark mb-2">Current Ratio</h6>
                      <p class="fs-sm text-secondary mb-0">Measures whether a firm has enough resources to meet its short-term obligations.</p>
                    </div>
                  </div>
                </div><!-- col -->
              </div><!-- row -->
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`]
};
@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')
  <script>
    var ruuData = @json($ruu);
    var anggotaData = @json($anggotas);
  </script>
    <div class="main main-app p-3 p-lg-4">
      <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
          <ol class="breadcrumb fs-sm mb-1">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kelompok 2 & 3</li>
          </ol>
          <h4 class="main-title mb-0">Kelompok 2 & 3</h4>
        </div>
        <div class="d-flex gap-2 mt-3 mt-md-0">
          <button type="button" class="btn btn-white d-flex align-items-center gap-2"><i class="ri-share-line fs-18 lh-1"></i>Share</button>
          <button type="button" class="btn btn-white d-flex align-items-center gap-2"><i class="ri-printer-line fs-18 lh-1"></i>Print</button>
          <a href="#modal3" class="btn btn-primary d-flex align-items-center gap-2"  data-bs-toggle="modal"><i class="ri-bar-chart-2-line fs-18 lh-1"></i>Customize<span class="d-none d-sm-inline"> Dashboard</span></a>
        </div>
      </div>

      <div class="row g-3" id="content">

         {{-- <div class="col-xl-9">
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
        </div><!-- col --> --}}
        {{-- <div class="col-xl-3">
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
        </div><!-- col --> --}}
        {{-- <div class="col-sm-6 col-xl">
          <div class="card card-one">
            <div class="card-body">
              <div id="apexChart4" class="mb-1"></div>
              <h3 class="card-value">0.9:8</h3>
              <div class="progress ht-5 mb-2">
                <div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <label class="fw-semibold text-dark mb-1">Quick Ratio Goal: 1.0 or higher</label>
              <p class="fs-sm text-secondary mb-0">Measures your Accounts Receivable / Current Liabilities</p>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->
        <div class="col-sm-6 col-xl">
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
        </div><!-- col -->
        <div class="col-md-7 col-xl-5">
          <div class="card card-one card-wallet">
            <div class="card-body">
              <div class="finance-icon">
                <i class="ri-mastercard-fill"></i>
                <i class="ri-visa-line"></i>
              </div>
              <label class="card-title mb-1">Available Balance</label>
              <h2 class="card-value mb-auto"><span>$</span>130,058.50</h2>

              <label class="card-title mb-1">Account Number</label>
              <div class="d-flex align-items-center gap-4 mb-3">
                <div class="d-flex gap-1">
                  <span class="badge-dot"></span>
                  <span class="badge-dot"></span>
                  <span class="badge-dot"></span>
                  <span class="badge-dot"></span>
                </div>
                <div class="d-flex gap-1">
                  <span class="badge-dot"></span>
                  <span class="badge-dot"></span>
                  <span class="badge-dot"></span>
                  <span class="badge-dot"></span>
                </div>
                <div class="d-flex gap-1">
                  <span class="badge-dot"></span>
                  <span class="badge-dot"></span>
                  <span class="badge-dot"></span>
                  <span class="badge-dot"></span>
                </div>
                <h5 class="ff-numerals mb-0">5314</h5>
              </div>

              <label class="card-title mb-1">Account Name</label>
              <h5 class="mb-0">Richard M. Christensen</h5>
            </div><!-- card-body -->
            <div id="apexChart6" class="apex-chart-two"></div>
          </div><!-- card -->
        </div><!-- col -->
        <div class="col-md-5 col-xl-6">
          <div class="card card-one">
            <div class="card-header">
              <h6 class="card-title">Income &amp; Expenses</h6>
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body pb-4">
              <div id="apexChart7"></div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->
        <div class="col-xl-6">
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
        </div><!-- col --> 
        <div class="col-xl-8">
          <div class="card card-one">
            <div class="card-header">
              <h6 class="card-title">Program Legislasi Nasional 2020-2024</h6>
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div class="row g-4">
                <div class="col-md-6">
                  <div id="apexChart8" class="apex-chart-three"></div>
                  <label for="xSelect">Select X Column:</label>
                    <select id="xSelect">
                      @foreach ($columns as $column)
                          <option value="fraksi">Fraksi</option>
                      @endforeach
                    </select>

                    <label for="ySelect">Select Y Column:</label>
                    <select id="ySelect">
                        @foreach ($columns as $column)
                          <option value="{{ $column }}">{{ $column }}</option>
                        @endforeach
                    </select> 

                    <button id="updateChart">Update Chart</button>

                    <div id="chart"></div>
      
                </div><!-- col -->
                 <div class="col-md-6">
                 <div class="text-center fw-semibold text-dark">Latest RUU</div>
                 @foreach ($ruu as $index => $item)
                     @if ($index<3)                       
                    <div class="d-flex">
                      <i class="{{ $item->pengusul == 'Dpr' ? 'ri-hotel-line' : ($item->pengusul == 'Dpd' ? 'ri-wallet-3-line' : 'ri-shopping-bag-3-line') }} fs-48 lh-1 me-3"></i>

                      <div>
                        <h6 class="fw-semibold text-dark mb-1">{{ $item->pengusul }}</h6>
                        <p class="fs-sm text-secondary mb-0">{{ $item->judul }}</p>
                      </div>
                    </div>
                    @else
                         @break
                     @endif
                 @endforeach
               
                </div><!-- col --> 
              </div><!-- row -->
            </div><!-- card-body -->
            
          </div><!-- card -->
        </div><!-- col -->
         <div class="col-xl-4">
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
                <h1>{{ count($ruu) }}</h1>
                <!-- <p>86.24%</p> -->
              </div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col --> 
         <div class="col">
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
        </div><!-- col --> --}}
        
      </div><!-- row --> 

      <div class="main-footer mt-5">
        <span>&copy; 2023. DPR RI</span>
      </div><!-- main-footer -->
    </div><!-- main -->

    {{-- Modal Full Customize Dashboard--}}
       <div class="modal fade" id="modal3" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Customize Dashboard</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div><!-- modal-header -->
          <div class="modal-body container text-center">
            <div class="row align-items-start">
              <div class="col">
                Chart
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Cluster</th>
                      <th scope="col">Type</th>
                      <th scope="col">Grid</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($charts as $chart)
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td id="itemName_{{ $loop->iteration }}"></td>
                          <td id="grid_{{ $loop->iteration }}"></td>
                          <form action="/dashboard/content" method="post">
                              @csrf
                            <input type="hidden" value="{{ $chart->id }}" name="clusterId">
                            <td><button type="submit" class="btn btn-primary">Add</button></td>
                          </form>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="col">
                content
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Cluster</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                @foreach ($contents as $content)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $content->chart->id }}</td>
                      <td style="display: flex; justify-content: center;  align-items: center;">
                        <form action="/dashboard/content/{{ $content->id }}" method="post">
                        <a href="/dashboard/chart/{{ $content->chart->id }}" class="btn btn-primary">Edit </a>
                          @method('delete')
                          @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                      </td>
                    </tr>
                @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div><!-- modal-footer -->
        </div><!-- modal-content -->
      </div><!-- modal-content -->
    </div><!-- modal -->

    <script>
    // JavaScript object to store HTML structures with ID
    const htmlStructures = {
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
        </div><!-- col -->`, `line Chart`, `9`],
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
        </div><!-- col -->`, `Nama 2`, `3`],
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
        </div><!-- col -->` , `Nama 3`, `6`],
        4: [`<div class="col-xl-12">
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
        </div><!-- col -->`, `Nama 4`, `12`],
        5: [`<div class="col-xl-6">
          <div class="card card-one">
            <div class="card-body">
              <div id="apexChart4" class="mb-1"></div>
              <h3 class="card-value">0.9:8</h3>
              <div class="progress ht-5 mb-2">
                <div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <label class="fw-semibold text-dark mb-1">Quick Ratio Goal: 1.0 or higher</label>
              <p class="fs-sm text-secondary mb-0">Measures your Accounts Receivable / Current Liabilities</p>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col -->`, `Nama 5`, `6`],
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
        </div><!-- col -->`, `Nama 6`, `8`],
        7: [`<div class="col-xl-8">
          <div class="card card-one">
            <div class="card-header">
              <h6 class="card-title">Program Legislasi Nasional 2020-2024</h6>
              <nav class="nav nav-icon nav-icon-sm ms-auto">
                <a href="" class="nav-link"><i class="ri-refresh-line"></i></a>
                <a href="" class="nav-link"><i class="ri-more-2-fill"></i></a>
              </nav>
            </div><!-- card-header -->
            <div class="card-body p-4">
              <div class="row g-4">
                <div class="col-md-6">
                  <div id="apexChart8" class="apex-chart-three"></div>
                </div><!-- col -->
                 <div class="col-md-6">
                 <div class="text-center fw-semibold text-dark">Latest RUU</div>
                 @foreach ($ruu as $index => $item)
                     @if ($index<3)                       
                    <div class="d-flex">
                      <i class="{{ $item->pengusul == 'Dpr' ? 'ri-hotel-line' : ($item->pengusul == 'Dpd' ? 'ri-wallet-3-line' : 'ri-shopping-bag-3-line') }} fs-48 lh-1 me-3"></i>

                      <div>
                        <h6 class="fw-semibold text-dark mb-1">{{ $item->pengusul }}</h6>
                        <p class="fs-sm text-secondary mb-0">{{ $item->judul }}</p>
                      </div>
                    </div>
                    @else
                         @break
                     @endif
                 @endforeach
               
                </div><!-- col --> 
              </div><!-- row -->
            </div><!-- card-body -->
            
          </div><!-- card -->
        </div><!-- col -->`, 'Bar Chart', `8`],
        8: [` <div class="col-xl-4">
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
                <h1>{{ count($ruu) }}</h1>
                <!-- <p>86.24%</p> -->
              </div>
            </div><!-- card-body -->
          </div><!-- card -->
        </div><!-- col --> `, `Nama 8`, `4`],

    };

    // Declare variables outside the loop
    let contentId, htmlContent, containerContent, containerContentName, itemName, containerGrid, grid;

    @foreach ($contents as $content)
      // Access the HTML structure based on the PHP value
      contentId = {{ $content->chart->id }};
      htmlContent = htmlStructures[contentId][0];
      
      // Create a containerContent element and set its innerHTML
      containerContent = document.getElementById('content');
      containerContent.innerHTML += htmlContent;

    @endforeach
    @foreach ($charts as $chart)
      itemName = htmlStructures[{{ $loop->iteration }}][1]
      containerContentName = document.getElementById('itemName_{{ $loop->iteration }}');
      containerContentName.innerHTML += itemName;

      grid = htmlStructures[{{ $loop->iteration }}][2]
      containerGrid = document.getElementById('grid_{{ $loop->iteration }}');
      containerGrid.innerHTML += grid;
    @endforeach
</script>

@endsection

@section('custom_script')
  <script src="/lib/apexcharts/apexcharts.min.js"></script>

  <script src="/js/db.data.js"></script>
  <script src="/js/db.finance.js"></script>

@endsection
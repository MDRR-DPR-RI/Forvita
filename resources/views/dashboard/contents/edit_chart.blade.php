@extends('dashboard.layouts.main')

@section('custom_vendor')
 <!-- Vendor CSS -->

@endsection

@section('page_content')

 <div class="main main-docs">
      <div class="container">
      
<br><br><br>
  <form action="/dashboard/chart/{{ $chart->id }}" method="post">
              @method('put')
              @csrf
        <div class="card card-example">
          <div class="card-body">
            <label for="judul">Select Data:</label>
            <select id="select2B" class="form-select">
                @foreach ($juduls as $judulOption)
                    <option value="{{ $judulOption }}">{{ $judulOption }}</option>
                @endforeach
            </select>
            <br>
            <label for="keterangan">Select xValue:</label>
            <select name="keterangan" id="keterangan">
                @foreach ($keterangans as $keteranganOption)
                    <option value="{{ $keteranganOption }}">{{ $keteranganOption }}</option>
                @endforeach
            </select>
          </div><!-- card-body -->
          <div class="card-footer">
            <pre><code class="language-html"></code></pre>
          </div><!-- card-footer -->
        </div><!-- card -->

            <button type="submit" class="btn btn-primary">Done</button>
    </form>
            </div>
      </div>
@endsection

@section('custom_script')


@endsection

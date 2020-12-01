@extends('layouts.master')


@section('content')
<div id="print-area">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Jatuh Tempo</h6>
      <!-- <a href="{{ route('transaksis.create')}}" class="btn btn-primary ">
        <i class="fas fa-plus-square"></i> Tambah
      </a> -->
      <form class="form-inline" method="get" action="{{ route('laporan.jatuhtempo') }}">
        <label class="mt-2 mr-sm-2" for="tahun">Tahun</label>
        <input type="number" class="form-control mt-2 mr-sm-2" id="tahun" name="tahun" placeholder="Tahun" value="{{ $tahun }}">

        <label class="mt-2 mr-sm-2" for="bulan">Bulan</label>
        <select class="form-control mt-2 mr-sm-2" id="bulan" name="bulan">
          <option value="">Semua Bulan</option>
          @if($tahun != null)
            @foreach($bulans as $item)
            <option value="{{ $item }}" {{ $bulan == $item ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
          @endif
        </select>

        <label class="mt-2 mr-sm-2" for="pegawai">Pegawai</label>
        @if($pegawai_login->jabatan == 'admin')
        <select class="form-control mt-2 mr-sm-2" name="pegawai">
          <option value="">Semua Pegawai</option>
            @foreach($pegawais as $item)
            <option value="{{ $item->nip }}" {{ $pegawai == $item->nip ? 'selected' : '' }}>{{ $item->nama }}</option>
            @endforeach
        </select>
        @else
        <input type="text" class="form-control mt-2 mr-sm-2" name="pegawai" placeholder="Pegawai" value="{{ $pegawai_login->nama }}" readonly>
        @endif

        <label class="mt-2 mr-sm-2" for="customer">Customer</label>
        <select class="form-control mt-2 mr-sm-2" name="customer">
          <option value="">Semua Customer</option>
            @foreach($customers as $item)
            <option value="{{ $item->idcustomers }}" {{ $customer == $item->idcustomers ? 'selected' : '' }}>{{ $item->nama }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-2 screen-area">Cari</button>
      </form>

      <button class="btn btn-success screen-area mt-2" onclick="printing()">Print</button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          @if($tahun != null && $bulan == null)
          <thead>
            <tr>
              <th>Bulan</th>
              <th>Jumlah</th>
            </tr>
          </thead>

          <tbody>
            @foreach($cicilans as $key => $cicilan)
              <tr>
                <td>{{ $key }}</td>
                <td>{{ $cicilan->count() }}</td>
              </tr>
            @endforeach

          </tbody>
          @elseif($tahun != null && $bulan != null)
          <thead>
            <tr>
              <th>Tenggat Waktu</th>
              <th>Cicilan Ke</th>
              <th>Nominal</th>
              <!-- <th>ID</th> -->
              <th>Tipe</th>
              <th>Pegawai</th>
              <th>Customer</th>
            </tr>
          </thead>

          <tbody>
            @foreach($cicilans as $key => $cicilan)
              <tr>
                <td>{{ $cicilan->tenggat_waktu }}</td>
                <td>{{ $cicilan->cicilan_ke }}</td>
                <td>Rp{{ $cicilan->formatUang($cicilan->nominal) }}</td>
                <!-- <td>{{ $cicilan->id_cicilan }}</td> -->
                <td>{{ $cicilan->cicilans->transaksis->units->tipes->nama }}</td>
                <td>{{ $cicilan->cicilans->transaksis->pegawais->nama ?? '' }}</td>
                <td>{{ $cicilan->cicilans->transaksis->customers->nama ?? '' }}</td>
              </tr>
            @endforeach

          </tbody>
          @else
          <thead>
            <tr>
              <th>Tahun</th>
              <th>Jumlah</th>
            </tr>
          </thead>

          <tbody>
            @foreach($cicilans as $key => $cicilan)
              <tr>
                <td>{{ $key }}</td>
                <td>{{ $cicilan->count() }}</td>
              </tr>
            @endforeach

          </tbody>
          @endif
        </table>
      </div>
    </div>
  </div>

  @if(!($tahun != null && $bulan != null) && $labels->count() > 0 && $data->count() > 0)
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan</h6>
    </div>
    <div class="card-body">
      <div class="chart-pie">
        <canvas id="grafikPenjualan"></canvas>
      </div>
    </div>
  </div>
  @endif
  <!-- /.container-fluid -->
</div>

@endsection
@push('scripts')
<script type="text/javascript">
@if(!($tahun != null && $bulan != null) && $labels->count() > 0 && $data->count() > 0)
  // Bar Chart Example
  var labels = [];
  @foreach($labels as $label)
    labels.push('{{$label}}')
  @endforeach
  var data = {{$data->values()}};
  var max = {{max($data->values()->toArray())}};
  
  var ctx = document.getElementById("grafikPenjualan");
  var grafikPenjualan = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: "Kelahiran",
        backgroundColor: "#4e73df",
        hoverBackgroundColor: "#2e59d9",
        borderColor: "#4e73df",
        data: data,
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'tahun'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 6
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: max,
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              // return '$' + number_format(value);
              return number_format(value) + ' orang';
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            // return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
            return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' orang';
          }
        }
      },
    }
  });
@endif
</script>
@endpush
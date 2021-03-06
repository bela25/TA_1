@extends('layouts.master')


@section('content')
<div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Penjualan</h6>
      <form class="form-inline" method="get" action="{{ route('laporan.penjualan') }}">
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
        <input type="text" class="form-control mt-2 mr-sm-2" name="pegawai_nama" placeholder="Pegawai" value="{{ $pegawai_login->nama }}" readonly>
        <input type="hidden" name="pegawai" value="{{$pegawai_login->nip}}">
        @endif

        <!-- <label class="mt-2 mr-sm-2" for="customer">Customer</label>
        <select class="form-control mt-2 mr-sm-2" name="customer">
          <option value="">Semua Customer</option>
            @foreach($customers as $item)
            <option value="{{ $item->idcustomers }}" {{ $customer == $item->idcustomers ? 'selected' : '' }}>{{ $item->nama }}</option>
            @endforeach
        </select> -->

        <label class="mt-2 mr-sm-2" for="lokasi">Lokasi</label>
        <select class="form-control mt-2 mr-sm-2" name="lokasi">
          <option value="">Semua Lokasi</option>
            @foreach($lokasis as $item)
            <option value="{{ $item->idlokasi }}" {{ $lokasi == $item->idlokasi ? 'selected' : '' }}>{{ $item->nama_apartemen }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-2 screen-area">Cari</button>
      </form>

      <button class="btn btn-success screen-area mt-2" onclick="printing()">Print</button>
    </div>
    <div class="card-body" id="print-area">
      <div class="text-center my-5">
        <h3 class="text-primary font-weight-bold">Laporan Penjualan</h3>
        <h4 class="text-dark">TamanSari Urban</h4>
      </div>
      @if($tahun != null && $bulan == null)
      <p>Tahun: <span class="text-primary font-weight-bold">{{$tahun}}</span></p>
      @elseif($tahun != null && $bulan != null)
      <p>Bulan: <span class="text-primary font-weight-bold">{{$bulan}} {{$tahun}}</span></p>
      @endif
      @if($pegawai == null)
      <p>Pegawai: <span class="text-primary font-weight-bold">Semua Pegawai</span></p>
      @else
      <p>Pegawai: <span class="text-primary font-weight-bold">{{ \App\Pegawai::find($pegawai)->nama }}</span></p>
      @endif
      @if($lokasi == null)
      <p>Lokasi: <span class="text-primary font-weight-bold">Semua Lokasi</span></p>
      @else
      <p>Lokasi: <span class="text-primary font-weight-bold">{{ \App\Lokasi::find($lokasi)->nama_apartemen }}</span></p>
      @endif
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          @if($tahun != null && $bulan == null)
          <thead>
            <tr>
              <th>Bulan</th>
              <th>Jumlah</th>
            </tr>
          </thead>

          <tbody>
            @foreach($transaksis as $key => $transaksi)
              <tr>
                <td>{{ $key }}</td>
                <td>{{ $transaksi->count() }}</td>
              </tr>
            @endforeach

          </tbody>
          @elseif($tahun != null && $bulan != null)
          <thead>
            <tr>
              <th>No</th>
              <th>ID Transaksi</th>
              <th>Nama Customer</th>
              <th>Tanggal Beli</th>
              <th>Unit</th>
              @if($lokasi == null)
              <th>Lokasi</th>
              @endif
              <th>Jenis Bayar</th>
              <th>Lunas</th>
              @if($pegawai == null)
              <th>Pegawai</th>
              @endif
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            @foreach($transaksis as $key => $transaksi)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $transaksi->id_transaksi }}</td>
                <td>{{ $transaksi->customers->nama ?? '' }}</td>
                <td>{{ $transaksi->tanggal }}</td>
                <td>{{ $transaksi->units->nama() ?? '' }}</td>
                @if($lokasi == null)
                <td>{{ $transaksi->units->towers->lokasis->nama_apartemen ?? '' }}</td>
                @endif
                <td>{{ $transaksi->jenis_bayar }}</td>
                <td>{{ $transaksi->tgl_pelunasan }}</td>
                @if($pegawai == null)
                <td>{{ $transaksi->pegawais->nama ?? '' }}</td>
                @endif
                <td><span class="{{$transaksi->status == 'aktif' ? 'text-success' : 'text-danger'}}">{{ $transaksi->status }}</span></td>
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
            @foreach($transaksis as $key => $transaksi)
              <tr>
                <td>{{ $key }}</td>
                <td>{{ $transaksi->count() }}</td>
              </tr>
            @endforeach

          </tbody>
          @endif
        </table>
      </div>
      @if($tahun != null && $bulan != null)
      <p>Unit Terjual: <span class="text-primary font-weight-bold">{{$transaksis->count()}}</span></p>
      <p>Status Aktif: <span class="text-primary font-weight-bold">{{$transaksis->where('status','aktif')->count()}}</span></p>
      <p>Status Tidak Aktif: <span class="text-primary font-weight-bold">{{$transaksis->where('status','tidak aktif')->count()}}</span></p>
      @endif
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
        label: "Penjualan",
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
              return number_format(value) + ' unit';
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
            return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' unit';
          }
        }
      },
    }
  });
@endif
</script>
@endpush
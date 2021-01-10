@extends('layouts.master')


@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
    <!-- <a href="{{ route('pembayaran_bookings.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a> -->
  </div>
  <div class="card-body">
    <ul class="list-group">
      <li class="list-group-item">
        Unit: {{$transaksi->units->nama()}} - Tower {{$transaksi->units->towers->nama}}, {{$transaksi->units->towers->lokasis->nama_apartemen}}
      </li>
      <li class="list-group-item">
        Customer: {{$transaksi->customers->nama}}
      </li>
      <li class="list-group-item">
        Pegawai: {{$transaksi->pegawais->nama ?? ''}}
      </li>
    </ul>
  </div>
</div>

<!-- Booking -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pembayaran Booking</h6>
    <!-- <a href="{{ route('pembayaran_bookings.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Transaksi</th>
            <th>Customer</th>
            <th>Nominal</th>
            <th>Tanggal Pembayaran</th>
            <th>Bukti</th>
            <th>Verifikasi</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @if(isset($pembayaran_booking))
          <tr>
            <td><a href="{{route('transaksis.index')}}">{{$transaksi->id_transaksi}}</a></td>
            <td><a href="{{route('transaksis.index')}}">{{$transaksi->customers->nama}}</a></td>
            <td>{{$pembayaran_booking->nominal()}}</td>
            <td>{{$pembayaran_booking->tanggalBayar()}}</td>
            <td><a href="{{asset($pembayaran_booking->gambar_bukti)}}" target="_blank">{{$pembayaran_booking->gambar_bukti}}</a></td>
            <td>
              @if($pembayaran_booking->gambar_bukti != null)
                @if($pembayaran_booking->verifikasi == 'diterima')
                <span class="badge badge-success">diterima</span>
                @elseif($pembayaran_booking->verifikasi == 'tidak diterima')
                <span class="badge badge-danger">tidak diterima</span>
                @else
                <span class="badge badge-warning">diproses</span>
                @endif
              @else
                <span class="badge badge-secondary">Belum bayar</span>
              @endif
            </td>
            <td>
              @if($pembayaran_booking->verifikasi == 'diproses')
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verifikasi-diterima{{$pembayaran_booking->id_pembayaranbooking}}">Terima</button>
              <div class="modal fade" id="verifikasi-diterima{{$pembayaran_booking->id_pembayaranbooking}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data verifikasi pembayaran booking ini akan diterima, apakah Anda yakin?&hellip;</p>
                       <form role="form" action="{{route('pembayaran_bookings.verifikasi',$pembayaran_booking)}}" method="post" id="diterima{{$pembayaran_booking->id_pembayaranbooking}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="hidden" name="verifikasi" value="diterima">
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-success" form="diterima{{$pembayaran_booking->id_pembayaranbooking}}">Terima</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verifikasi-tidakditerima{{$pembayaran_booking->id_pembayaranbooking}}">Tidak diterima</button>
              <div class="modal fade" id="verifikasi-tidakditerima{{$pembayaran_booking->id_pembayaranbooking}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data verifikasi pembayaran booking ini akan tidak diterima, apakah Anda yakin?&hellip;</p>
                       <form role="form" action="{{route('pembayaran_bookings.verifikasi',$pembayaran_booking)}}" method="post" id="tidakditerima{{$pembayaran_booking->id_pembayaranbooking}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="hidden" name="verifikasi" value="tidak diterima">
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-danger" form="tidakditerima{{$pembayaran_booking->id_pembayaranbooking}}">Tidak Diterima</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

              <!-- <a href="{{route('pembayaran_bookings.edit',$pembayaran_booking)}}" class="btn btn-primary">Ubah</a> -->
              <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$pembayaran_booking->id_pembayaranbooking}}">Hapus</button>
              <div class="modal fade" id="delete{{$pembayaran_booking->id_pembayaranbooking}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data ini akan dihapus secara permanen, Anda yakin untuk menghapus?&hellip;</p>
                       <form role="form" action="{{route('pembayaran_bookings.destroy',$pembayaran_booking)}}" method="post" id="hapus{{$pembayaran_booking->id_pembayaranbooking}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$pembayaran_booking->id_pembayaranbooking}}">Yes</button>
                    </div>
                  </div>
                </div>
              </div> -->
              @endif
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- DataTales DP -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pembayaran DP</h6>
    <!-- <a href="{{ route('pembayaran_dps.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Transaksi</th>
            <th>Customer</th>
            <th>Nominal</th>
            <th>Tanggal Pembayaran</th>
            <th>Bukti</th>
            <th>Verifikasi</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @if(isset($pembayaran_dp))
          <tr>
            <td><a href="{{route('transaksis.index')}}">{{$transaksi->id_transaksi}}</a></td>
            <td><a href="{{route('transaksis.index')}}">{{$transaksi->customers->nama}}</a></td>
            <td>{{$pembayaran_dp->nominal()}}</td>
            <td>{{$pembayaran_dp->tanggalBayar()}}</td>
            <td><a href="{{asset($pembayaran_dp->gambar_bukti)}}" target="_blank">{{$pembayaran_dp->gambar_bukti}}</a></td>
            <td>
              @if($pembayaran_dp->gambar_bukti != null)
                @if($pembayaran_dp->verifikasi == 'diterima')
                <span class="badge badge-success">diterima</span>
                @elseif($pembayaran_dp->verifikasi == 'tidak diterima')
                <span class="badge badge-danger">tidak diterima</span>
                @else
                <span class="badge badge-warning">diproses</span>
                @endif
              @else
                <span class="badge badge-secondary">Belum bayar</span>
              @endif
            </td>
            <td>
              @if($pembayaran_dp->verifikasi == 'diproses')
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verifikasi-diterima{{$pembayaran_dp->id_pembayarandp}}">Terima</button>
              <div class="modal fade" id="verifikasi-diterima{{$pembayaran_dp->id_pembayarandp}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data verifikasi pembayaran dp ini akan diterima, apakah Anda yakin?&hellip;</p>
                       <form role="form" action="{{route('pembayaran_dps.verifikasi',$pembayaran_dp)}}" method="post" id="diterima{{$pembayaran_dp->id_pembayarandp}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="hidden" name="verifikasi" value="diterima">
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-success" form="diterima{{$pembayaran_dp->id_pembayarandp}}">Terima</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verifikasi-tidakditerima{{$pembayaran_dp->id_pembayarandp}}">Tidak diterima</button>
              <div class="modal fade" id="verifikasi-tidakditerima{{$pembayaran_dp->id_pembayarandp}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data verifikasi pembayaran dp ini akan tidak diterima, apakah Anda yakin?&hellip;</p>
                       <form role="form" action="{{route('pembayaran_dps.verifikasi',$pembayaran_dp)}}" method="post" id="tidakditerima{{$pembayaran_dp->id_pembayarandp}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="hidden" name="verifikasi" value="tidak diterima">
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-danger" form="tidakditerima{{$pembayaran_dp->id_pembayarandp}}">Tidak Diterima</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- <a href="{{route('pembayaran_dps.edit',$pembayaran_dp)}}" class="btn btn-primary">Ubah</a> -->
              <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$pembayaran_dp->id_pembayarandp}}">Hapus</button>
              <div class="modal fade" id="delete{{$pembayaran_dp->id_pembayarandp}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data ini akan dihapus secara permanen, Anda yakin untuk menghapus?&hellip;</p>
                       <form role="form" action="{{route('pembayaran_dps.destroy',$pembayaran_dp)}}" method="post" id="hapus{{$pembayaran_dp->id_pembayarandp}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$pembayaran_dp->id_pembayarandp}}">Yes</button>
                    </div>
                  </div>
                </div>
              </div> -->
              @endif
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- DataTales Cicilan -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pembayaran Cicilan</h6>
    @if($transaksi->status == 'aktif' && ($cicilan == null || $cicilan->pembayaran_cicilans->where('cicilan_terakhir','iya')->count() <= 0))
    <form method="get" action="{{ route('pembayaran_cicilans.create') }}">
      <input type="hidden" name="transaksi" value="{{$transaksi->id_transaksi}}">
      <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah</button>
    </form>
    @else
    Tidak bisa menambah cicilan karena transaksi dibatalkan (tidak aktif) atau sudah ada cicilan terakhir
    @endif
  </div>
  <div class="card-body">
    @if($cicilan != null)
    <div class="row mb-3">
      <div class="col">Tanggal Awal: {{ $cicilan->tanggalMulai() }}</div>
      <div class="col">Tanggal Akhir: {{ $cicilan->tanggalAkhir() }}</div>
      <div class="col">Bunga: {{ $cicilan->bunga }}</div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Transaksi</th>
            <th>Customer</th>
            <th>Cicilan Ke-</th>
            <th>Nominal</th>
            <th>Tanggal Pembayaran</th>
            <th>Bukti</th>
            <th>Tenggat Waktu</th>
            <th>Verifikasi</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($cicilan->pembayaran_cicilans as $pembayaran_cicilan)
          <tr>
            <td><a href="{{route('transaksis.index')}}">{{$transaksi->id_transaksi}}</a></td>
            <td><a href="{{route('transaksis.index')}}">{{$transaksi->customers->nama}}</a></td>
            <td>{{$pembayaran_cicilan->cicilan_ke}}</td>
            <td>{{$pembayaran_cicilan->nominal()}}</td>
            <td>{{$pembayaran_cicilan->tanggalBayar()}}</td>
            <td><a href="{{asset($pembayaran_cicilan->gambar_bukticicilan)}}" target="_blank">{{$pembayaran_cicilan->gambar_bukticicilan}}</a></td>
            <td>{{$pembayaran_cicilan->tenggatWaktu()}}</td>
            <td>
              @if($pembayaran_cicilan->gambar_bukticicilan != null)
                @if($pembayaran_cicilan->verifikasi == 'diterima')
                <span class="badge badge-success">diterima</span>
                @elseif($pembayaran_cicilan->verifikasi == 'tidak diterima')
                <span class="badge badge-danger">tidak diterima</span>
                @else
                <span class="badge badge-warning">diproses</span>
                @endif
              @else
                <span class="badge badge-secondary">Belum bayar</span>
              @endif
            </td>
            <td>
              @if($pembayaran_cicilan->verifikasi == 'diproses' && $pembayaran_cicilan->gambar_bukticicilan != null)
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verifikasi-diterima{{$pembayaran_cicilan->id_pembayarancicilan}}">Terima</button>
              <div class="modal fade" id="verifikasi-diterima{{$pembayaran_cicilan->id_pembayarancicilan}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data verifikasi pembayaran cicilan ini akan diterima, apakah Anda yakin?&hellip;</p>
                       <form role="form" action="{{route('pembayaran_cicilans.verifikasi',$pembayaran_cicilan)}}" method="post" id="diterima{{$pembayaran_cicilan->id_pembayarancicilan}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="hidden" name="verifikasi" value="diterima">
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-success" form="diterima{{$pembayaran_cicilan->id_pembayarancicilan}}">Terima</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verifikasi-tidakditerima{{$pembayaran_cicilan->id_pembayarancicilan}}">Tidak diterima</button>
              <div class="modal fade" id="verifikasi-tidakditerima{{$pembayaran_cicilan->id_pembayarancicilan}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data verifikasi pembayaran cicilan ini akan tidak diterima, apakah Anda yakin?&hellip;</p>
                       <form role="form" action="{{route('pembayaran_cicilans.verifikasi',$pembayaran_cicilan)}}" method="post" id="tidakditerima{{$pembayaran_cicilan->id_pembayarancicilan}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="hidden" name="verifikasi" value="tidak diterima">
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-danger" form="tidakditerima{{$pembayaran_cicilan->id_pembayarancicilan}}">Tidak Diterima</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              @endif
              <!-- end cek verifikasi -->
              @if($pembayaran_cicilan->gambar_bukticicilan == null)
              <a href="{{route('pembayaran_cicilans.edit',$pembayaran_cicilan)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$pembayaran_cicilan->id_pembayarancicilan}}">Hapus</button>
              <div class="modal fade" id="delete{{$pembayaran_cicilan->id_pembayarancicilan}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data ini akan dihapus secara permanen, Anda yakin untuk menghapus?&hellip;</p>
                       <form role="form" action="{{route('pembayaran_cicilans.destroy',$pembayaran_cicilan)}}" method="post" id="hapus{{$pembayaran_cicilan->id_pembayarancicilan}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$pembayaran_cicilan->id_pembayarancicilan}}">Yes</button>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              <!-- end cek gambar bukti -->
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    Belum ada daftar cicilan
    @endif
  </div>
</div>

<!-- Pembatalan -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pembatalan</h6>
    <!-- <a href="{{ route('pembayaran_bookings.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Transaksi</th>
            <th>Customer</th>
            <th>Alasan</th>
            <th>Nominal</th>
            <th>Tanggal Pembatalan</th>
            <th>Tanggal Pengembalian</th>
            <th>Status</th>
            <th>Alasan dari Pegawai</th>
            <th>Bukti</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @if(isset($pembatalan))
          <tr>
            <td><a href="{{route('transaksis.show', $pembatalan->transaksis)}}">{{$pembatalan->transaksis->id_transaksi}}</a></td>
            <td><a href="#">{{$pembatalan->transaksis->customers->nama}}</a></td>
            <td>{{$pembatalan->alasan}}</td>
            <td>{{$pembatalan->showNominal()}}</td>
            <td>{{$pembatalan->tanggalBatal()}}</td>
            <td>{{$pembatalan->tanggalPengembalian()}}</td>
            <td><span class="badge {{ $pembatalan->status == 'aktif' ? 'badge-success' : 'badge-danger' }}">{{$pembatalan->status}}</span></td>
            <td>{{$pembatalan->alasan_pegawai}}</td>
            <td>
              @if($pembatalan->gambar_bukti == null && auth()->user()->pegawai->jabatan == 'admin')
              <a href="{{route('pembatalans.upload',$pembatalan)}}">Upload bukti transfer</a>
              @else
              <a href="{{asset($pembatalan->gambar_bukti)}}" target="_blank">{{$pembatalan->gambar_bukti}}</a>
              @endif
            </td>
            <td>
            @if($pembatalan->gambar_bukti == null)
              @if($pembatalan->bolehDibatalkan())
              <button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#cancel{{$pembatalan->id_pembatalan}}">
              Cancel</button>
              <div class="modal fade" id="cancel{{$pembatalan->id_pembatalan}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Apakah Anda yakin ingin meng-cancel pengajuan pembatalan transaksi ini?&hellip;</p>
                      <form role="form" action="{{route('pembatalans.cancel',$pembatalan)}}" method="post" id="batal{{$pembatalan->id_pembatalan}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="form-group">
                          <textarea name="alasan_pegawai" id="alasan_pegawai" cols="30" rows="7" class="form-control" placeholder="Berikan alasan" required>{{$pembatalan->alasan_pegawai}}</textarea>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" form="batal{{$pembatalan->id_pembatalan}}">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#reason{{$pembatalan->id_pembatalan}}">
              Tambah Alasan</button>
              <div class="modal fade" id="reason{{$pembatalan->id_pembatalan}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Silahkan berikan alasan tambahan pada pengajuan pembatalan transaksi ini?&hellip;</p>
                      <form role="form" action="{{route('pembatalans.alasan',$pembatalan)}}" method="post" id="alasan{{$pembatalan->id_pembatalan}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="form-group">
                          <input type="text" class="form-control" name="admin" value="{{$pembatalan->pegawais->nama}}" required readonly>
                        </div>
                        <div class="form-group">
                          <textarea name="alasan_pegawai" id="alasan_pegawai" cols="30" rows="7" class="form-control" placeholder="Berikan alasan" required>{{$pembatalan->alasan_pegawai}}</textarea>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" form="alasan{{$pembatalan->id_pembatalan}}">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <a href="{{route('pembatalans.edit',$pembatalan)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$pembatalan->id_pembatalan}}">
               Hapus</button>
              <div class="modal fade" id="delete{{$pembatalan->id_pembatalan}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Peringatan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data ini akan dihapus secara permanen, Anda yakin untuk menghapus?&hellip;</p>
                      <form role="form" action="{{route('pembatalans.destroy',$pembatalan)}}" method="post" id="hapus{{$pembatalan->id_pembatalan}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}

                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$pembatalan->id_pembatalan}}">Yes</button>
                    </div>
                  </div>
                </div>
              </div> -->
              @endif
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

@endsection
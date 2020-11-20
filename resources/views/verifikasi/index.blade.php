@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Verifikasi</h6>
    <a href="{{ route('transaksis.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> PLUS
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Customer</th>
            <th>Unit</th>
            <th>Harga Jual</th>
            <th>Jenis Bayar</th>
            <th>Tanggal Pembayaran</th>
            <th>Verifikasi</th>
            <th>Status</th>
            <th>Tanggal Pelunasan</th>
            <th>Pegawai</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($transaksis as $transaksi)
          <tr>
            <td><a href="">{{$transaksi->customers->nama}}</a></td>
            <td><a href="">{{$transaksi->units->nama()}}</a></td>
            <td>Rp{{$transaksi->units->hargaJual()}}</td>
            <td>{{$transaksi->jenis_bayar}}</td>
            <td>{{$transaksi->tanggal}}</td>
            <td>
              @if($transaksi->verifikasi == 'diterima')
              <span class="badge badge-success">{{$transaksi->verifikasi}}</span>
              @else
              <span class="badge badge-warning">{{$transaksi->verifikasi}}</span>
              @endif
            </td>
            <td>
              @if($transaksi->status == 'aktif')
              <span class="badge badge-success">{{$transaksi->status}}</span>
              @else
              <span class="badge badge-danger">{{$transaksi->status}}</span>
              @endif
            </td>
            @if($transaksi->tgl_pelunasan == null)
            <td>Belum dilunasi</td>
            @else
            <td>{{$transaksi->tgl_pelunasan}}</td>
            @endif
            @if($transaksi->pegawais == null)
            <!-- <td><a href="{{route('transaksis.pegawai',$transaksi)}}">Tentukan pegawai</a></td> -->
            <td>
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#handle{{$transaksi->id_transaksi}}">Tangani</button>
              <div class="modal fade" id="handle{{$transaksi->id_transaksi}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tangani Transaksi Ini</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Data Anda akan disimpan pada transaksi ini&hellip;</p>
                      <form role="form" action="{{route('transaksis.simpanpegawai',$transaksi)}}" method="post" id="tangani{{$transaksi->id_transaksi}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="form-group">
                          <input type="hidden" name="pegawai" class="form-control" value="{{$pegawai->nip}}">
                          <input type="text" name="pegawai_nama" class="form-control" value="{{$pegawai->nip}} - {{$pegawai->nama}}" readonly>
                        </div>
                        <div class="form-group">
                          <label>Komisi</label>
                          <input type="text" name="komisi" class="form-control" value="Rp{{$transaksi->units->formatUang($transaksi->units->komisi())}}" readonly>
                        </div>
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary" form="tangani{{$transaksi->id_transaksi}}">Simpan</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            </td>
            @else
            <td>
              <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#handle{{$transaksi->id_transaksi}}">{{$transaksi->pegawais->nama}}</button>
              <div class="modal fade" id="handle{{$transaksi->id_transaksi}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Komisi</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">{{$pegawai->nip}} - {{$pegawai->nama}}</p>
                      <h5>
                        <span class="badge badge-success">
                          Rp{{$transaksi->formatUang($transaksi->komisipegawai->bonus)}}
                        </span>
                      </h5>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            </td>
            @endif
            <td>
              <a href="{{route('transaksis.edit',$transaksi)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$transaksi->id_transaksi}}">Hapus</button>
              <div class="modal fade" id="delete{{$transaksi->id_transaksi}}">
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
                      <form role="form" action="{{route('transaksis.destroy',$transaksi)}}" method="post" id="hapus{{$transaksi->id_transaksi}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}

                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$transaksi->id_transaksi}}">Yes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- /.container-fluid -->

@endsection
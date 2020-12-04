@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pembayaran DP</h6>
    <a href="{{ route('pembayaran_dps.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Customer</th>
            <th>Tanggal Pembayaran</th>
            <th>Nominal</th>
            <th>Bukti</th>
            <th>Verifikasi</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($pembayaran_dps as $pembayaran_dp)
          <tr>
            <td><a href="{{route('transaksis.index')}}">{{$pembayaran_dp->transaksis->customers->nama}}</a></td>
            <td>{{$pembayaran_dp->tanggal_bayar}}</td>
            <td>{{$pembayaran_dp->nominal()}}</td>
            <td><a href="{{asset($pembayaran_dp->gambar_bukti)}}" target="_blank">{{$pembayaran_dp->gambar_bukti}}</a></td>
            <td>
              @if($pembayaran_dp->verifikasi == 'diterima')
              <span class="badge badge-success">diterima</span>
              @elseif($pembayaran_dp->verifikasi == 'diterima')
              <span class="badge badge-danger">tidak diterima</span>
              @else
              <span class="badge badge-warning">diproses</span>
              @endif
            </td>
            <td>
              <a href="{{route('pembayaran_dps.edit',$pembayaran_dp)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$pembayaran_dp->id_pembayarandp}}">Hapus</button>
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
                       <form role="form" action="{{route('pembayaran_dps.destroy',$pembayaran_dp)}}" method="post" id="hapus{{$pembayaran_dp->id_pembayarancicilan}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$pembayaran_dp->id_pembayarandp}}">Yes</button>
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
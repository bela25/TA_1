@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Pembatalan</h6>
    <a href="{{ route('pembatalans.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Customer</th>
            <th>Alasan</th>
            <th>Tanggal Pembatalan</th>
            <th>Tanggal Pengembalian</th>
            <th>Admin</th>
            <th>Bukti</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($pembatalans as $pembatalan)
          <tr>
            <td><a href="#">{{$pembatalan->transaksis->customers->nama}}</a></td>
            <td>{{$pembatalan->alasan}}</td>
            <td>{{$pembatalan->tanggal_batal}}</td>
            <td>{{$pembatalan->tgl_pengembalian}}</td>
            <td><a href="#">{{$pembatalan->pegawais->nama ?? ''}}</td>
            <td>
              @if($pembatalan->gambar_bukti == null)
              <a href="{{route('pembatalans.upload',$pembatalan)}}">Upload bukti transfer</a>
              @else
              <a href="{{asset($pembatalan->gambar_bukti)}}" target="_blank">{{$pembatalan->gambar_bukti}}</a>
              @endif
            </td>
            <td>
              @if($pembatalan->gambar_bukti == null)
              <a href="{{route('pembatalans.edit',$pembatalan)}}" class="btn btn-primary">Ubah</a>
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

                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$pembatalan->id_pembatalan}}">Yes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              @endif
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
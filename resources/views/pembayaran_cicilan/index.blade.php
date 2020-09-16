@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Pembayaran Cicilan</h6>
    <a href="{{ route('pembayaran_cicilans.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> PLUS
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Kode Cicilan</th>
            <th>Cicilan Ke- </th>
            <th>Tanggal Pembayaran</th>
            <th>Harga Cicilan</th>
            <th>Bukti</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($pembayaran_cicilans as $pembayaran_cicilan)
          <tr>
            <td><a href="{{route('cicilans.index')}}">{{$pembayaran_cicilan->cicilans->id_cicilan}}</a></td>
            <td>{{$pembayaran_cicilan->cicilan-ke}}</td>
            <td>{{$pembayaran_cicilan->tanggal_bayar}}</td>
            <td>{{$pembayaran_cicilan->nominal}}</td>
            <td>{{$pembayaran_cicilan->gambar_bukticicilan}}</td>
            <td>
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
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$pembayaran_cicilan->id_pembayarancicilan}}">Yes</button>
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
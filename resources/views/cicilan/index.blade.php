@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Cicilan</h6>
    <a href="{{ route('cicilans.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Transaksi</th>
            <th>Tanggal Awal</th>
            <th>Tanggal Akhir</th>
            <th>Bunga</th>
            <th>Interaksi</th>
          </tr>
        </thead>

       <tbody>
         @foreach($cicilans as $cicilan)
         <tr>
            <td><a href="{{route('transaksis.index')}}">{{$cicilan->transaksis->customer}}</a></td>
            <td>{{$cicilan->tanggal_mulai}}</td>
            <td>{{$cicilan->tanggal_akhir}}</td>
            <td>{{$cicilan->bunga}}</td>
            <td>
              <a href="{{route('cicilans.edit',$cicilan)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$cicilan->id_cicilan}}">Hapus</button>
              <div class="modal fade" id="delete{{$cicilan->id_cicilan}}">
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
                       <form role="form" action="{{route('cicilans.destroy',$cicilan)}}" method="post" id="hapus{{$cicilan->id_cicilan}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$cicilan->id_cicilan}}">Yes</button>
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
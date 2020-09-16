@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Harga Jual</h6>
    <a href="{{ route('hargajuals.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> PLUS
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Harga Jual</th>
            <th>Tgl Awal</th>
            <th>Tgl Akhir</th>
            <th>Tipe</th>
            <th>Tower</th>
            <th>Arah</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
        @foreach($harga_juals as $harga_jual)
         <tr>
            <td>{{$harga_jual->hargajual_cash}}</td>
            <td>{{$harga_jual->tgl_awal}}</td>
            <td>{{$harga_jual->tgl_akhir}}</td>
            <td><a href="{{route('tipe_units.index')}}">{{$harga_jual->tipes->nama}}</a></td>
            <td><a href="{{route('towers.index')}}">{{$harga_jual->towers->nama}}</a></td>
            <td><a href="{{route('arah_units.index')}}">{{$harga_jual->arahs->pemandngan}}</a></td>
            <td>{{$harga_jual->created_at}}</td>
            <td>{{$harga_jual->updated_at}}</td>
            <td>
              <a href="{{route('hargajuals.edit',$harga_jual)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$harga_jual->idhargajual}}">Hapus</button>
              <div class="modal fade" id="delete{{$harga_jual->idhargajual}}">
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
                      <form role="form" action="{{route('hargajuals.destroy',$harga_jual)}}" method="post" id="hapus{{$harga_jual->idhargajual}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}

                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$harga_jual->idhargajual}}">Yes</button>
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
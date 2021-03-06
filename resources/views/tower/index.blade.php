@extends('layouts.master')

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tower</h6>
    <a href="{{ route('towers.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Keterangan</th>
            <th>Lokasi</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($towers as $tower)
          <tr>
            <td>{{$tower->nama}}</td>
            <td>{{$tower->keterangan}}</td>
            <td><a href="{{route('lokasis.index')}}">{{$tower->lokasis->nama_apartemen}}</a></td>
            <td>{{$tower->created_at}}</td>
            <td>{{$tower->updated_at}}</td>
            <td>
              @if(!$tower->adaTransaksi())
              <a href="{{route('towers.edit',$tower)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$tower->id_tower}}">Hapus</button>
              <div class="modal fade" id="delete{{$tower->id_tower}}">
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
                      <form role="form" action="{{route('towers.destroy',$tower)}}" method="post" id="hapus{{$tower->id_tower}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}

                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$tower->id_tower}}">Yes</button>
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
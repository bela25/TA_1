@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    <a href="{{ route('chattings.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> PLUS
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Pesan</th>
            <th>Tgl Pesan</th>
            <th>Pegawai</th>
            <th>Customer</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($chattings as $chatting)
          <tr>
            <td>{{$chatting->pesan}}</td>
            <td>{{$chatting->tgl_pesan}}</td>
            <td><a href="{{route('pegawais.index')}}">{{$chatting->pegawais->nama}}</a></td>
            <td><a href="{{route('customers.index')}}">{{$chatting->customers->nama}}</a></td>
            <td>{{$chatting->created_at}}</td>
            <td>{{$chatting->updated_at}}</td>
            <td>
              <a href="{{route('chattings.edit',$chatting)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$chatting->id_chat}}">Hapus</button>
              <div class="modal fade" id="delete{{$chatting->id_chat}}">
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
                       <form role="form" action="{{route('chattings.destroy',$chatting)}}" method="post" id="hapus{{$chatting->id_chat}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$chatting->id_chat}}">Yes</button>
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
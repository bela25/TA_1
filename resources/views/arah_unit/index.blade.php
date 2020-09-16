@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Arah Unit</h6>
    <a href="{{ route('arah_units.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> PLUS
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Pemandangan</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
         </tr>
       </thead>

       <tbody>
        @foreach($arah_units as $arah_unit)
        <tr>
          <td>{{$arah_unit->pemandangan}}</td>
          <td>{{$arah_unit->created_at}}</td>
          <td>{{$arah_unit->updated_at}}</td>
          <td>
            <a href="{{route('arah_units.edit',$arah_unit)}}" class="btn btn-primary">Ubah</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$arah_unit->id_arah}}">Hapus</button>
            <div class="modal fade" id="delete{{$arah_unit->id_arah}}">
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
                    <form role="form" action="{{route('arah_units.destroy',$arah_unit)}}" method="post" id="hapus{{$arah_unit->id_arah}}">
                      {{csrf_field()}}
                      {{method_field('delete')}}

                      <!-- /.card-body -->
                    </form>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary" form="hapus{{$arah_unit->id_arah}}">Yes</button>
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
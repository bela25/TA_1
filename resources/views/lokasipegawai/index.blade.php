@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Lokasi Pegawai</h6>
    @if(auth()->user()->pegawai->jabatan == 'admin')
    <a href="{{ route('lokasipegawais.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> PLUS
    </a>
    @endif
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Pegawai</th>
            <th>Lokasi</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
         @foreach($lokasipegawais as $lokasipegawai)
         <tr>
            <td>{{$lokasipegawai->lokasis->nama_apartemen}}</td>
            <td>{{$lokasipegawai->pegawais->nama}}</td>
            <td>
              @if(auth()->user()->pegawai->jabatan == 'admin')
              <a href="{{route('lokasipegawais.edit',$lokasipegawai)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$lokasipegawai->id}}">Hapus</button>
              <div class="modal fade" id="delete{{$lokasipegawai->id}}">
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
                       <form role="form" action="{{route('lokasipegawais.destroy',$lokasipegawai)}}" method="post" id="hapus{{$lokasipegawai->id}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$lokasipegawai->id}}">Yes</button>
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
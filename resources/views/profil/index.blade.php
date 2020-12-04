@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
    @if(auth()->user()->pegawai->jabatan == 'admin')
    <a href="{{ route('profils.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
    @endif
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Judul Profil</th>
            <!-- <th>Tanggal Dibuat</th> -->
            <th>Keterangan</th>
            <th>Gambar</th>
            <th>Admin</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($profils as $profil)
          <tr>
            <td>{{$profil->judul_profil}}</td>
            <!-- <td>{{$profil->tgl}}</td> -->
            <td>{{$profil->keterangan}}</td>
            <td>{{$profil->gambar}}</td>
            <td><a href="{{route('pegawais.index')}}">{{$profil->pegawais->nama}}</a></td>
            <td>{{$profil->created_at}}</td>
            <td>{{$profil->updated_at}}</td>
            <td>
              @if(auth()->user()->pegawai->jabatan == 'admin')
              <a href="{{route('profils.edit',$profil)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$profil->idprofil}}">Hapus</button>
              <div class="modal fade" id="delete{{$profil->idprofil}}">
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
                       <form role="form" action="{{route('profils.destroy',$profil)}}" method="post" id="hapus{{$profil->idprofil}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$profil->idprofil}}">Yes</button>
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
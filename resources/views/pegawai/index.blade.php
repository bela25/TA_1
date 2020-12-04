@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pegawai</h6>
    @if(auth()->user()->pegawai->jabatan == 'admin')
    <a href="{{ route('pegawais.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
    @endif
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>No telp</th>
            <th>Jabatan</th>
            <th>Email</th>
            <th>Username</th>
            <!-- <th>Password</th> -->
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pegawais as $pegawai)
          <tr>
            <td>{{$pegawai->nip}}</td>
            <td>{{$pegawai->nama}}</td>
            <td>{{$pegawai->alamat}}</td>
            <td>{{$pegawai->tgl_lahir}}</td>
            <td>{{$pegawai->tempat_lahir}}</td>
            <td>{{$pegawai->no_telp}}</td>
            <td>{{$pegawai->jabatan}}</td>
            <td>{{$pegawai->user->email}}</td>
            <td>{{$pegawai->user->username ?? ''}}</td>
            <!-- <td>{{$pegawai->password}}</td> -->
            <td>{{$pegawai->created_at}}</td>
            <td>{{$pegawai->updated_at}}</td>
            <td>
              @if($pegawai->transaksis->count() <= 0)
              <a href="{{route('pegawais.edit',$pegawai)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$pegawai->nip}}">Hapus</button>
              <div class="modal fade" id="delete{{$pegawai->nip}}">
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
                       <form role="form" action="{{route('pegawais.destroy',$pegawai)}}" method="post" id="hapus{{$pegawai->nip}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$pegawai->nip}}">Yes</button>
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
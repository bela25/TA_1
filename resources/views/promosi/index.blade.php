@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Promosi</h6>
    @if(auth()->user()->pegawai->jabatan == 'admin')
    <a href="{{ route('promosis.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
    @endif
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Judul Promosi</th>
            <th>Gambar</th>
            <th>Keterangan</th>
            <th>Tanggal_awal</th>
            <th>Tanggal_akhir</th>
            <th>Admin</th>
            <th>Lokasi</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
         @foreach($promosis as $promosi)
         <tr>
            <td>{{$promosi->judul_promosi}}</td>
            <td><a href="{{asset($promosi->gambar)}}" target="_blank">{{$promosi->gambar}}</a></td>
            <td>{{$promosi->keterangan}}</td>
            <td>{{$promosi->tgl_awal}}</td>
            <td>{{$promosi->tgl_akhir}}</td>
            <td><a href="{{route('pegawais.index')}}">{{$promosi->pegawais->nama}}</a></td>
            <td><a href="{{route('lokasis.index')}}">{{$promosi->lokasis->nama_apartemen}}</a></td>
            <td>{{$promosi->updated_at}}</td>
            <td>
            @if(auth()->user()->pegawai->jabatan == 'admin')
              @if(!$promosi->sudahBerakhir())
              <a href="{{route('promosis.edit',$promosi)}}" class="btn btn-primary">Ubah</a>
              @endif
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$promosi->idpromosi}}">Hapus</button>
              <div class="modal fade" id="delete{{$promosi->idpromosi}}">
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
                       <form role="form" action="{{route('promosis.destroy',$promosi)}}" method="post" id="hapus{{$promosi->idpromosi}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$promosi->idpromosi}}">Yes</button>
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
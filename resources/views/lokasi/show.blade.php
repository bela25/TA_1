@extends('layouts.master')


@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Lokasi</h6>
    <a href="{{ route('lokasis.index')}}" class="btn btn-secondary ">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>
  <div class="card-body">
    <h3 class="text-primary">{{ $lokasi->nama_apartemen }}</h3>
  </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Berita</h6>
    <a href="{{ route('beritas.create', ['lokasi' => $lokasi->idlokasi])}}" class="btn btn-primary">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Apartemen</th>
            <th>Tanggal</th>
            <th>Progres</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
         @foreach($beritas as $berita)
         <tr>
            <td>{{$berita->lokasis->nama_apartemen}}</td>
            <td>{{$berita->tanggalBerita()}}</td>
            <td>{{$berita->progress}}</td>
            <td>{{$berita->created_at}}</td>
            <td>{{$berita->updated_at}}</td>
            <td>
              <a href="{{route('beritas.edit',$berita)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$berita->id}}">Hapus</button>
              <div class="modal fade" id="delete{{$berita->id}}">
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
                       <form role="form" action="{{route('beritas.destroy',$berita)}}" method="post" id="hapus{{$berita->id}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$berita->id}}">Yes</button>
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
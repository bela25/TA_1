@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Gambar Produk</h6>
    <a href="{{ route('gambar_produks.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Gambar</th>
            <th>Tipe</th>
            <th>Lokasi</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($gambar_produks as $gambar_produk)
          <tr>
            <td><a href="{{asset($gambar_produk->nama_gambar)}}" target="_blank">{{$gambar_produk->nama_gambar}}</a></td>
            <td><a href="{{route('tipe_units.index')}}">{{$gambar_produk->tipes->nama}}</a></td>
            <td><a href="{{route('lokasis.index')}}">{{$gambar_produk->lokasis->nama_apartemen}}</a></td>
            <td>{{$gambar_produk->created_at}}</td>
            <td>{{$gambar_produk->updated_at}}</td>
            <td>
              @if(!$gambar_produk->adaTransaksi())
              <a href="{{route('gambar_produks.edit',$gambar_produk)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$gambar_produk->id_gambarproduk}}">Hapus</button>
              <div class="modal fade" id="delete{{$gambar_produk->id_gambarproduk}}">
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
                       <form role="form" action="{{route('gambar_produks.destroy',$gambar_produk)}}" method="post" id="hapus{{$gambar_produk->id_gambarproduk}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$gambar_produk->id_gambarproduk}}">Yes</button>
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
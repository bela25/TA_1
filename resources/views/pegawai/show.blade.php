@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pegawai</h6>
    <a href="{{ route('pegawais.index')}}" class="btn btn-secondary ">
       Kembali
    </a>
  </div>
  <div class="card-body">
    <h5>Nama: <strong>{{ $pegawai->nama }}</strong></h5>
    <p>NIP: <strong>{{ $pegawai->nip }}</strong></p>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Transaksi</th>
            <th>Bonus</th>
            <th>Interaksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transaksis as $transaksi)
          <tr>
            <td><a href="{{ route('transaksis.show', $transaksi) }}">{{$transaksi->id_transaksi}}</a></td>
            <td>{{$transaksi->komisipegawai->formatBonus()}}</td>
            <td>
              <!-- <a href="{{route('pegawais.edit',$pegawai)}}" class="btn btn-primary">Ubah</a>
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
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$pegawai->nip}}">Yes</button>
                    </div>
                  </div>
                </div>
              </div> -->
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
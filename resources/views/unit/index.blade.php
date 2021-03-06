@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Unit</h6>
    @if(auth()->user()->pegawai->jabatan == 'admin')
    <a href="{{ route('units.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> Tambah
    </a>
    @endif
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Unit</th>
            <th>Status</th>
            <th>Lantai</th>
            <th>Tipe</th>
            <th>Tower</th>
            <th>Lokasi</th>
            <th>Arah</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
        @foreach($units as $unit)
          <tr>
            <td>{{$unit->no_unit}}</td>
            <td>{{$unit->status}}</td>
            <td>{{$unit->lantai}}</td>
            <td><a href="{{route('tipe_units.index')}}">{{$unit->tipes->nama}}</a></td>
            <td><a href="{{route('towers.index')}}">{{$unit->towers->nama}}</a></td>
            <td><a href="{{route('towers.index')}}">{{$unit->towers->lokasis->nama_apartemen}}</a></td>
            <td><a href="{{route('arah_units.index')}}">{{$unit->arahs->pemandangan}}</a></td>
            <td>{{$unit->created_at}}</td>
            <td>{{$unit->updated_at}}</td>
            <td>
            @if(auth()->user()->pegawai->jabatan == 'admin')
              @if($unit->transaksis->count() <= 0 || $unit->status == 'tersedia')
              <a href="{{route('units.edit',$unit)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$unit->id_unit}}">Hapus</button>
              <div class="modal fade" id="delete{{$unit->id_unit}}">
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
                      <form role="form" action="{{route('units.destroy',$unit)}}" method="post" id="hapus{{$unit->id_unit}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}

                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$unit->id_unit}}">Yes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              @endif
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
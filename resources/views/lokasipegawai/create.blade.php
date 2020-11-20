@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('lokasipegawais.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Lokasi</label>
      <select name="lokasi" class="form-control select2" style="width: 100%;" required>
        @foreach($lokasis as $lokasi)
          <option value="{{$lokasi->idlokasi}}">{{$lokasi->nama_apartemen}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Pegawai</label>
      <select name="pegawai" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawais as $pegawai)
          <option value="{{$pegawai->nip}}">{{$pegawai->nama}}</option>
        @endforeach
      </select>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
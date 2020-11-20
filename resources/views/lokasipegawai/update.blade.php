@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('lokasipegawais.update',$lokasipegawai)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label>Lokasi</label>
      <select name="lokasi" class="form-control select2" style="width: 100%;" required>
        @foreach($lokasis as $lokasi)
          @if($lokasi->idlokasi == $lokasipegawai->lokasi)
          <option value="{{$lokasi->idlokasi}}" selected>{{$lokasi->nama_apartemen}}</option>
          @else
          <option value="{{$lokasi->idlokasi}}">{{$lokasi->nama_apartemen}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Pegawai</label>
      <select name="pegawai" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawais as $pegawai)
          @if($pegawai->nip == $lokasipegawai->pegawai)
          <option value="{{$pegawai->nip}}" selected>{{$pegawai->nama}}</option>
          @else
          <option value="{{$pegawai->nip}}">{{$pegawai->nama}}</option>
          @endif
        @endforeach
      </select>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('lokasis.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="namaapartemen">Nama Apartemen</label>
      <input type="text" class="form-control" id="namaapartemen" placeholder="Isi Nama Apartemen" name="namaapartemen" required>
    </div>
    <div class="form-group">
      <label for="namaprovinsi">Provinsi</label>
      <input type="text" class="form-control" id="namaprovinsi" placeholder="Isi Provinsi" name="namaprovinsi" required>
    </div>
    <div class="form-group">
      <label for="namakota">Kota</label>
      <input type="text" class="form-control" id="namakota" placeholder="Isi Kota" name="namakota" required>
    </div>
    <div class="form-group">
      <label for="namaalamat">Alamat</label>
      <input type="text" class="form-control" id="namaalamat" placeholder="Isi Alamat" name="namaalamat" required>
    </div>
    <div class="form-group">
      <label for="latlon">Latitude, Longitude</label>
      <input type="text" class="form-control" id="lonlat" placeholder="contoh: -7.319951871469308, 112.76722279848939. copy dari google maps" name="lonlat" required>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
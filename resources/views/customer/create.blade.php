@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('customers.store')}}" method="post">
	{{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama">
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" id="alamat" placeholder="Isi Alamat" name="alamat">
    </div>
    <div class="form-group">
      <label for="noktp">No KTP</label>
      <input type="text" class="form-control" id="noktp" placeholder="Isi No KTP" name="noktp">
    </div>
    <div class="form-group">
      <label for="notelp">No Telp</label>
      <input type="text" class="form-control" id="notelp" placeholder="Isi No Telp" name="notelp">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Isi Email" name="email">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Isi Username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Isi Password">
    </div>
    <div class="form-group">
      <label>Gender</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="lakilaki" name="customRadio" value="laki-laki" checked>
        <label for="lakilaki" class="custom-control-label">Laki-laki</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="perempuan" name="customRadio" value="perempuan">
        <label for="perempuan" class="custom-control-label">Perempuan</label>
      </div>
    </div>
    <div class="form-group">
      <label for="alamat">Tempat Lahir</label>
      <input type="text" class="form-control" id="tempatlahir" placeholder="Isi Tempat Lahir" name="tempatlahir">
    </div>
    <div class="form-group">
      <label>Tanggal Lahir:</label>
      <div class="input-group date" id="tgllahir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir">
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      <!-- /.input group -->
      </div>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
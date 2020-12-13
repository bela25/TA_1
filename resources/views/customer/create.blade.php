@extends('layouts.master')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- form start -->
<form role="form" action="{{route('customers.store')}}" method="post">
	{{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" required>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" id="alamat" placeholder="Isi Alamat" name="alamat" required>
    </div>
    <div class="form-group">
      <label for="noktp">No KTP</label>
      <input type="text" class="form-control" id="noktp" placeholder="Isi No KTP" name="noktp" required>
    </div>
    <div class="form-group">
      <label for="notelp">No Telp</label>
      <input type="text" class="form-control" id="notelp" placeholder="Isi No Telp" name="notelp" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Isi Email" name="email" required>
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Isi Username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Isi Password" name="password" required>
    </div>
    <div class="form-group">
      <label for="password_confirmation">Konfirmasi Password</label>
      <input type="password" class="form-control" id="password_confirmation" placeholder="Isi Password" name="password_confirmation" required>
    </div>
    <div class="form-group">
      <label>Gender</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="lakilaki" name="customRadio" value="laki-laki" checked required>
        <label for="lakilaki" class="custom-control-label">Laki-laki</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="perempuan" name="customRadio" value="perempuan" required>
        <label for="perempuan" class="custom-control-label">Perempuan</label>
      </div>
    </div>
    <div class="form-group">
      <label for="alamat">Tempat Lahir</label>
      <input type="text" class="form-control" id="tempatlahir" placeholder="Isi Tempat Lahir" name="tempatlahir" required>
    </div>
    <div class="form-group">
      <label>Tanggal Lahir:</label>
      <div class="input-group date" id="tgllahir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tgllahir" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
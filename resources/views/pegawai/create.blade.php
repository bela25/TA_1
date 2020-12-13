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
<form role="form" action="{{route('pegawais.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="nip">NIP</label>
      <input type="text" class="form-control" id="nip" placeholder="Isi NIP" name="nip" required>
    </div>
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" required>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" id="alamat" placeholder="Isi Alamat" name="alamat" required>
    </div>
    <div class="form-group">
      <label for="tempatlahir">Tempat Lahir</label>
      <input type="text" class="form-control" id="tempatlahir" placeholder="Isi Tempat Lahir" name="tempatlahir" required>
    </div>
    <div class="form-group">
      <label for="tgllahir">Tanggal Lahir</label>
      <div class="input-group date" id="tgllahir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tgllahir" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="jabatan">Jabatan</label>
      <input type="text" class="form-control" id="jabatan" placeholder="Isi Jabatan" name="jabatan" required>
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
      <label for="tglbergabung">Tgl Bergabung</label>
      <div class="input-group date" id="tglbergabung" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input pilihtanggal" name="tglbergabung" data-target=".pilihtanggal" data-toggle="datetimepicker" required>
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
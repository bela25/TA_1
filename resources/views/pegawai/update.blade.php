@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pegawais.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="nip">NIP</label>
      <input type="text" class="form-control" id="nip" placeholder="Isi NIP" name="nip" value="{{$pegawai->nip}}">
    </div>
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" value="{{$pegawai->nama}}">
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" id="alamat" placeholder="Isi Alamat" name="alamat" value="{{$pegawai->alamat}}">
    </div>
    <div class="form-group">
      <label for="tempatlahir">Tempat Lahir</label>
      <input type="text" class="form-control" id="tempatlahir" placeholder="Isi Tempat Lahir" name="tempatlahir" value="{{$pegawai->tempat_lahir}}">
    </div>
    <div class="form-group">
      <label for="tgllahir">Tanggal Lahir</label>
      <input type="text" class="form-control" id="tgllahir" placeholder="Isi Tanggal Lahir" name="tgllahir" value="{{$pegawai->tgl_lahir}}">
    </div>
    <div class="form-group">
      <label for="jabatan">Jabatan</label>
      <input type="text" class="form-control" id="jabatan" placeholder="Isi Jabatan" name="jabatan" value="{{$pegawai->jabatan}}">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Isi Email" name="email" value="{{$pegawai->email}}">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Isi Username" name="username" value="{{$pegawai->username}}">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Isi Password">
    </div>
    <div class="form-group">
      <label for="tglbergabung">Tgl Bergabung</label>
      <input type="text" class="form-control" id="tglbergabung" placeholder="Isi Tanggal Bergabung" name="tglbergabung" value="{{$pegawai->tgl_bergabung}}">
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
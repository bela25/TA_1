@extends('layouts.master')

@section('content')
<!-- form start -->
@if($errors->any())
  <p class="alert alert-danger">{{$errors->first()}}</p>
@endif
<form role="form" action="{{route('pegawais.update', $pegawai)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="nip">NIP</label>
      <input type="text" class="form-control" id="nip" placeholder="Isi NIP" name="nip" value="{{$pegawai->nip}}" required disabled>
    </div>
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" value="{{$pegawai->nama}}" required>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" id="alamat" placeholder="Isi Alamat" name="alamat" value="{{$pegawai->alamat}}" required>
    </div>
    <div class="form-group">
      <label for="tempatlahir">Tempat Lahir</label>
      <input type="text" class="form-control" id="tempatlahir" placeholder="Isi Tempat Lahir" name="tempatlahir" value="{{$pegawai->tempat_lahir}}" required>
    </div>
    <div class="form-group">
      <label for="tgllahir">Tanggal Lahir</label>
      <div class="input-group date" id="tgllahir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir" value="{{$pegawai->tgl_lahir}}" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="jabatan">Jabatan</label>
      <input type="text" class="form-control" id="jabatan" placeholder="Isi Jabatan" name="jabatan" value="{{$pegawai->jabatan}}" required>
    </div>
    <div class="form-group">
      <label for="notelp">No Telp</label>
      <input type="text" class="form-control" id="notelp" placeholder="Isi No Telp" name="notelp" value="{{$pegawai->no_telp}}" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Isi Email" name="email" value="{{$pegawai->user->email}}" required>
    </div>
    <!-- <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Isi Username" name="username" value="{{$pegawai->user->username ?? ''}}" required>
    </div> -->
    <div class="form-group">
      <label for="tglbergabung">Tgl Bergabung</label>
      <div class="input-group date" id="tgllahir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tglbergabung" value="{{$pegawai->tgl_bergabung}}" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
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
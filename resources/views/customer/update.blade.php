@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('customers.store')}}" method="post">
	{{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" value="{{$customer->nama}}">
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" id="alamat" placeholder="Isi Alamat" name="alamat"
      value="{{$customer->alamat}}">
    </div>
    <div class="form-group">
      <label for="noktp">No KTP</label>
      <input type="text" class="form-control" id="noktp" placeholder="Isi No KTP" name="noktp"
      value="{{$customer->no_ktp}}">
    </div>
    <div class="form-group">
      <label for="tgllahir">Tanggal Lahir</label>
      <input type="text" class="form-control" id="tgllahir" placeholder="Isi Tanggal Lahir" name="tgllahir" value="{{$customer->tgl_lahir}}">
    </div>
    <div class="form-group">
      <label for="notelp">No Telp</label>
      <input type="text" class="form-control" id="notelp" placeholder="Isi No Telp" name="notelp"
      value="{{$customer->no_telp}}">
    </div>
    <div class="form-group">
      <label for="gender">Gender</label>
      <input type="text" class="form-control" id="gender" placeholder="Isi Gender" name="gender"
      value="{{$customer->gender}}">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Isi Email" name="email"
      value="{{$customer->email}}">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Isi Username" name="username" value="{{$customer->username}}">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Isi Password">
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
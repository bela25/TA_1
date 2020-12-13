@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('customers.update', $customer)}}" method="post">
	{{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" value="{{$customer->nama}}" required>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" id="alamat" placeholder="Isi Alamat" name="alamat"
      value="{{$customer->alamat}}" required>
    </div>
    <div class="form-group">
      <label for="noktp">No KTP</label>
      <input type="text" class="form-control" id="noktp" placeholder="Isi No KTP" name="noktp"
      value="{{$customer->no_ktp}}" required>
    </div>
    <div class="form-group">
      <label for="alamat">Tempat Lahir</label>
      <input type="text" class="form-control" id="tempatlahir" placeholder="Isi Tempat Lahir" name="tempatlahir" value="{{$customer->tempat_lahir}}" required>
    </div>
    <div class="form-group">
      <label for="tgllahir">Tanggal Lahir</label>
      <div class="input-group date" id="tgllahir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tgllahir" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required value="{{ $customer->tgl_lahir }}">
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="notelp">No Telp</label>
      <input type="text" class="form-control" id="notelp" placeholder="Isi No Telp" name="notelp"
      value="{{$customer->no_telp}}" required>
    </div>
    <div class="form-group">
      <label for="gender">Gender</label>
      <input type="text" class="form-control" id="gender" placeholder="Isi Gender" name="gender"
      value="{{$customer->gender}}" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Isi Email" name="email"
      value="{{$customer->user->email}}" required>
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Isi Username" name="username" value="{{$customer->user->username ?? ''}}" required>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
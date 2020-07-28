@extends('layouts.master')

@section('content')
<!-- form start -->
              <form role="form" action="{{route('customers.store')}}" method="post">
              	{{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" value="{{$customer->nama}}">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Isi Nama" name="alamat"
                    value="{{$customer->alamat}}">
                    <label for="noktp">No KTP</label>
                    <input type="text" class="form-control" id="noktp" placeholder="Isi Nama" name="noktp"
                    value="{{$customer->no_ktp}}">
                     <label for="tgllahir">Tanggal Lahir</label>
                    <input type="text" class="form-control" id="tgllahir" placeholder="Isi Nama" name="tgllahir" value="{{$customer->tgl_lahir}}">
                     <label for="notelp">No Telp</label>
                    <input type="text" class="form-control" id="notelp" placeholder="Isi Nama" name="notelp"
                    value="{{$customer->no_telp}}">
                    <label for="gender">Gender</label>
                    <input type="text" class="form-control" id="gender" placeholder="Isi Nama" name="gender"
                    value="{{$customer->gender}}">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Isi Nama" name="email"
                    value="{{$customer->email}}">
                     <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Isi Nama" name="username" value="{{$customer->username}}">
                   <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
@endsection
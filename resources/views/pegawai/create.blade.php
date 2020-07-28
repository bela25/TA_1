@extends('layouts.master')

@section('content')
<!-- form start -->
              <form role="form" action="{{route('pegawais.store')}}" method="post">
                {{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" placeholder="Isi nip" name="nip">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Isi Nama" name="alamat">
                    <label for="tempatlahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempatlahir" placeholder="Isi Nama" name="tempatlahir">
                    <label for="tgllahir">Tanggal Lahir</label>
                    <input type="text" class="form-control" id="tgllahir" placeholder="Isi Nama" name="tgllahir">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" placeholder="Isi Nama" name="jabatan">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Isi Nama" name="email">
                     <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Isi Nama" name="username">
                   <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                  </div>
                     <label for="tglbergabung">Tgl Bergabung</label>
                    <input type="text" class="form-control" id="tglbergabung" placeholder="Isi tglbergabung" name="tglbergabung">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
@endsection
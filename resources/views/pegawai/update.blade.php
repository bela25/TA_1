@extends('layouts.master')

@section('content')
<!-- form start -->
              <form role="form" action="{{route('pegawais.store')}}" method="post">
                {{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" placeholder="Isi nip" name="nip" value="{{$pegawai->nip}}">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" value="{{$pegawai->nama}}">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Isi Nama" name="alamat" value="{{$pegawai->alamat}}">
                    <label for="tempatlahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempatlahir" placeholder="Isi Nama" name="tempatlahir" value="{{$pegawai->tempat_lahir}}">
                    <label for="tgllahir">Tanggal Lahir</label>
                    <input type="text" class="form-control" id="tgllahir" placeholder="Isi Nama" name="tgllahir" value="{{$pegawai->tgl_lahir}}">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" placeholder="Isi Nama" name="jabatan" value="{{$pegawai->jabatan}}">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Isi Nama" name="email" value="{{$pegawai->email}}">
                     <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Isi Nama" name="username" value="{{$pegawai->username}}">
                   <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                  </div>
                     <label for="tglbergabung">Tgl Bergabung</label>
                    <input type="text" class="form-control" id="tglbergabung" placeholder="Isi tglbergabung" name="tglbergabung" value="{{$pegawai->tgl_bergabung}}">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
@endsection
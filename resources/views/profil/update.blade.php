@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('profils.update',$profil)}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="judulprofil">Judul Profil</label>
      <input type="text" class="form-control" id="judulprofil" placeholder="Isi Nama" name="judulprofil"
      value="{{$profil->judul_profil}}">
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea class="form-control" rows="3" placeholder="ket ..." id="keterangan" value="{{$profil->keterangan}}"></textarea>
    </div>
    <div class="form-group">
      <label for="gambar">Gambar</label>
      <input type="text" class="form-control" id="gambar" placeholder="Isi Nama" name="gambar" value="{{$profil->gambar}}">
    </div>
    <div class="form-group">
      <label for="tgldibuat">Tanggal Dibuat</label>
      <input type="text" class="form-control" id="tgldibuat" placeholder="Isi Nama" name="tgldibuat" value="{{$profil->tgl}}">
    </div>
    <div class="form-group">
      <label>Admin</label>
      <select name="admin" class="form-control select2" style="width: 100%;">
        @foreach($pegawai as $pegawais)
          <option value="{{$pegawais->nip}}">{{$pegawais->nama}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
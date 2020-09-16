@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('profils.update',$profil)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="judulprofil">Judul Profil</label>
      <input type="text" class="form-control" id="judulprofil" placeholder="Isi Judul Profil" name="judulprofil"
      value="{{$profil->judul_profil}}">
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea class="form-control" rows="3" placeholder="Keterangan ..." id="keterangan" name="keterangan">{{$profil->keterangan}}</textarea>
    </div>
    <div class="form-group">
      <label for="gambar">Gambar</label>
      <input type="text" class="form-control" id="gambar" placeholder="Isi Gambar" name="gambar" value="{{$profil->gambar}}">
    </div>
    <div class="form-group">
      <label for="tgldibuat">Tanggal Dibuat</label>
      <input type="text" class="form-control" id="tgldibuat" placeholder="Isi Tanggal Dibuat" name="tgldibuat" value="">
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
@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('profils.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="judulprofil">Judul Profil</label>
      <input type="text" class="form-control" id="judulprofil" placeholder="Isi Judul Profil" name="judulprofil" required>
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea class="form-control" rows="3" placeholder="Keterangan ..." id="keterangan" name="keterangan" required></textarea>
    </div>
    <div class="from-group">
      <label for="exampleInputFile">Gambar</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar" required>
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="">Upload</span>
        </div>
      </div>
    </div>
    <div class="from-group">
      <label for="tgldibuat">Tanggal Dibuat</label>
      <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" id="tgldibuat" placeholder="Isi Tanggal Dibuat" name="tgldibuat" required>
      <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
      </div>
    </div>
    <div class="form-group">
      <label>Admin</label>
      <select name="admin" class="form-control select2" style="width: 100%;" required>
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
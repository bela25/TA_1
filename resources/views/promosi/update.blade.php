@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('promosis.update', $promosi)}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="judulpromosi">Judul Promosi</label>
      <input type="text" class="form-control" id="judulpromosi" placeholder="Isi Judul Promosi" name="judulpromosi"  value="{{$promosi->judul_promosi}}" required>
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea class="form-control" rows="3" placeholder="Keterangan ..." id="keterangan" name="keterangan" required>{{$promosi->keterangan}}</textarea>
    </div>
    <div class="form-group">
      <label for="exampleInputFile">Gambar</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar" value="{{$promosi->gambar}}">
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="">Upload</span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="tglawal">Tanggal Awal</label>
      <div class="input-group">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" id="tglawal" placeholder="Isi Tanggal Dibuat" name="tglawal" value="{{$promosi->tgl_awal}}" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="tglakhir">Tanggal Akhir</label>
      <div class="input-group">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" id="tglakhir" placeholder="Isi Tanggal Dibuat" name="tglakhir" value="{{$promosi->tgl_akhir}}" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Admin</label>
      <select name="admin" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawai as $pegawais)
          @if($pegawais->nip == $promosi->pegawai)
          <option value="{{$pegawais->nip}}" selected>{{$pegawais->nama}}</option>
          @else
          <option value="{{$pegawais->nip}}">{{$pegawais->nama}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Lokasi</label>
      <select name="lokasi" class="form-control select2" style="width: 100%;" required>
        @foreach($lokasi as $lokasis)
          @if($lokasis->idlokasi == $promosi->lokasi)
          <option value="{{$lokasis->idlokasi}}" selected>{{$lokasis->nama_apartemen}}</option>
          @else
          <option value="{{$lokasis->idlokasi}}">{{$lokasis->nama_apartemen}}</option>
          @endif
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
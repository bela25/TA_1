@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('promosis.update', $promosi)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="judulpromosi">Judul Promosi</label>
      <input type="text" class="form-control" id="judulpromosi" placeholder="Isi Judul Promosi" name="judulpromosi"  value="{{$promosi->judul_promosi}}">
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea class="form-control" rows="3" placeholder="Keterangan ..." id="keterangan" name="keterangan">{{$promosi->keterangan}}</textarea>
    </div>
    <div class="form-group">
      <label for="gambar">Gambar</label>
      <input type="text" class="form-control" id="gambar" placeholder="Isi Gambar" name="gambar"  value="{{$promosi->gambar}}">
    </div>
    <div class="form-group">
      <label for="tglawal">Tanggal Awal</label>
      <input type="text" class="form-control" id="tglawal" placeholder="Isi Tanggal Awal" name="tglawal"  value="{{$promosi->tgl_awal}}">
    </div>
    <div class="form-group">
      <label for="tglakhir">Tanggal Akhir</label>
      <input type="text" class="form-control" id="tglakhir" placeholder="Isi Tanggal Akhir" name="tglakhir"  value="{{$promosi->tgl_akhir}}">
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
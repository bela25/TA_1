@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('promosis.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="judulpromosi">Judul Promosi</label>
      <input type="text" class="form-control" id="judulpromosi" placeholder="Isi Nama" name="judulpromosi"  value="{{$promosi->judul_promosi}}">
      <label>Keterangan</label>
      <textarea class="form-control" rows="3" placeholder="ket ..." id="keterangan" value="{{$profil->keterangan}}"></textarea>
    </div>
    <label for="gambar">Gambar</label>
    <input type="text" class="form-control" id="gambar" placeholder="Isi Nama" name="gambar"  value="{{$promosi->gambar}}">
    <label for="tglawal">Tanggal Awal</label>
    <input type="text" class="form-control" id="tglawal" placeholder="Isi Nama" name="tglawal"  value="{{$promosi->tgl_awal}}">
    <label for="tglakhir">Tanggal Akhir</label>
    <input type="text" class="form-control" id="tglakhir" placeholder="Isi Nama" name="tglakhir"  value="{{$promosi->tgl_akhir}}">
    <div class="form-group">
      <label>Admin</label>
      <select name="admin" class="form-control select2" style="width: 100%;">
        @foreach($pegawai as $pegawais)
        <option value="{{$pegawais->nip}}">{{$pegawais->nama}}</option>
        @endforeach
      </select>
    </div>
    
  </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
@endsection
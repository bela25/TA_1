@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('promosis.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="judulpromosi">Judul Promosi</label>
      <input type="text" class="form-control" id="judulpromosi" placeholder="Isi Nama" name="judulpromosi">
      <div class="form-group">
        <label>Keterangan</label>
        <textarea class="form-control" rows="3" placeholder="ket ..." id="keterangan"></textarea>
      </div>
      <label for="gambar">Gambar</label>
      <input type="text" class="form-control" id="gambar" placeholder="Isi Nama" name="gambar">
      <label for="tglawal">Tanggal Awal</label>
      <input type="text" class="form-control" id="tglawal" placeholder="Isi Nama" name="tglawal">
      <label for="tglakhir">Tanggal Akhir</label>
      <input type="text" class="form-control" id="tglakhir" placeholder="Isi Nama" name="tglakhir">
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
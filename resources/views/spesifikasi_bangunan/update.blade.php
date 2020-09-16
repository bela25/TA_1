@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('spesifikasi_bangunans.store')}}" method="post">
	{{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="lantai">Lantai</label>
      <input type="text" class="form-control" id="lantai" placeholder="Isi Lantai" name="lantai" value="{{$spesifikasi_bangunan->lantai}}">
    </div>
    <div class="form-group">
      <label for="dinding">Dinding</label>
      <input type="text" class="form-control" id="dinding" placeholder="Isi Dinding" name="dinding" value="{{$spesifikasi_bangunan->dinding}}">
    </div>
    <div class="form-group">
      <label for="platfon">Platfon</label>
      <input type="text" class="form-control" id="platfon" placeholder="Isi Platfon" name="platfon" value="{{$spesifikasi_bangunan->platfon}}">
    </div>
    <div class="form-group">
      <label for="instalasilistrik">Instalasi Listrik</label>
      <input type="text" class="form-control" id="instalasilistrik" placeholder="Isi Instalasi Listrik" name="instalasilistrik" value="{{$spesifikasi_bangunan->instalasi_listrik}}">
    </div>
    <div class="form-group">
      <label for="sanitary">Sanitary</label>
      <input type="text" class="form-control" id="sanitary" placeholder="Isi Sanitary" name="sanitary" value="{{$spesifikasi_bangunan->sanitary}}">
    </div>
    <div class="form-group">
      <label for="pintu">Pintu</label>
      <input type="text" class="form-control" id="pintu" placeholder="Isi Pintu" name="pintu" value="{{$spesifikasi_bangunan->pintu}}">
    </div>
    <div class="form-group">
      <label for="jendela">Jendela</label>
      <input type="text" class="form-control" id="jendela" placeholder="Isi Jendela" name="jendela" value="{{$spesifikasi_bangunan->jendela}}">
    </div>
    <div class="form-group">
      <label for="air">Air</label>
      <input type="text" class="form-control" id="air" placeholder="Isi Air" name="air" value="{{$spesifikasi_bangunan->air}}">
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
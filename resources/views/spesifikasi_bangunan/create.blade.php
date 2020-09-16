@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('spesifikasi_bangunans.store')}}" method="post">
	{{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="lantai">Lantai</label>
      <input type="text" class="form-control" id="lantai" placeholder="Isi Lantai" name="lantai">
    </div>
    <div class="form-group">
      <label for="dinding">Dinding</label>
      <input type="text" class="form-control" id="dinding" placeholder="Isi Dinding" name="dinding">
    </div>
    <div class="form-group">
      <label for="platfon">Platfon</label>
      <input type="text" class="form-control" id="platfon" placeholder="Isi Plafonn" name="platfon">
    </div>
    <div class="form-group">
      <label for="instalasilistrik">Instalasi Listrik</label>
      <input type="text" class="form-control" id="instalasilistrik" placeholder="Isi Instalasi Listrk" name="instalasilistrik">
    </div>
    <div class="form-group">
      <label for="sanitary">Sanitary</label>
      <input type="text" class="form-control" id="sanitary" placeholder="Isi Sanitary" name="sanitary">
    </div>
    <div class="form-group">
      <label for="pintu">Pintu</label>
      <input type="text" class="form-control" id="pintu" placeholder="Isi Pintu" name="pintu">
    </div>
    <div class="form-group">
      <label for="jendela">Jendela</label>
      <input type="text" class="form-control" id="jendela" placeholder="Isi Jendela" name="jendela">
    </div>
    <div class="form-group">
      <label for="air">Air</label>
      <input type="text" class="form-control" id="air" placeholder="Isi Air" name="air">
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
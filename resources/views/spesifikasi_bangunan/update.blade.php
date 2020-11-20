@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('spesifikasi_bangunans.update',$spesifikasi_bangunan)}}" method="post">
	{{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="lantai">Lantai</label>
      <input type="text" class="form-control" id="lantai" placeholder="Isi Lantai" name="lantai" value="{{$spesifikasi_bangunan->lantai}}" required>
    </div>
    <div class="form-group">
      <label for="dinding">Dinding</label>
      <input type="text" class="form-control" id="dinding" placeholder="Isi Dinding" name="dinding" value="{{$spesifikasi_bangunan->dinding}}" required>
    </div>
    <div class="form-group">
      <label for="platfon">Platfon</label>
      <input type="text" class="form-control" id="platfon" placeholder="Isi Platfon" name="platfon" value="{{$spesifikasi_bangunan->platfon}}" required>
    </div>
    <div class="form-group">
      <label for="instalasilistrik">Instalasi Listrik</label>
      <input type="text" class="form-control" id="instalasilistrik" placeholder="Isi Instalasi Listrik" name="instalasilistrik" value="{{$spesifikasi_bangunan->instalasi_listrik}}" required>
    </div>
    <div class="form-group">
      <label for="sanitary">Sanitary</label>
      <input type="text" class="form-control" id="sanitary" placeholder="Isi Sanitary" name="sanitary" value="{{$spesifikasi_bangunan->sanitary}}" required>
    </div>
    <div class="form-group">
      <label for="pintu">Pintu</label>
      <input type="text" class="form-control" id="pintu" placeholder="Isi Pintu" name="pintu" value="{{$spesifikasi_bangunan->pintu}}" required>
    </div>
    <div class="form-group">
      <label for="jendela">Jendela</label>
      <input type="text" class="form-control" id="jendela" placeholder="Isi Jendela" name="jendela" value="{{$spesifikasi_bangunan->jendela}}" required>
    </div>
    <div class="form-group">
      <label for="air">Air</label>
      <input type="text" class="form-control" id="air" placeholder="Isi Air" name="air" value="{{$spesifikasi_bangunan->air}}" required>
    </div>
    <div class="form-group">
      <label>Admin</label>
      <select name="admin" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawai as $pegawais)
          @if($pegawais->nip == $spesifikasi_bangunan->pegawai)
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
          @if($lokasis->idlokasi == $spesifikasi_bangunan->lokasi)
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
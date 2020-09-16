@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('units.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="namaunit">Unit</label>
      <input type="text" class="form-control" id="namaunit" placeholder="Isi Unit" name="namaunit">
    </div>
    <div class="form-group">
      <label>Status</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="terjual" name="customRadio" value="terjual">
        <label for="terjual" class="custom-control-label">Terjual</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="tersedia" name="customRadio" value="tersedia">
        <label for="tersedia" class="custom-control-label">Tersedia</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="terbooking" name="customRadio" value="booking">
        <label for="terbooking" class="custom-control-label">Terbooking</label>
      </div>
    </div>
    <div class="form-group">
      <label for="lantai">Lantai</label>
      <input type="text" class="form-control" id="lantai" name="lantai">
    </div>
    <div class="form-group">
      <label>Tipe</label>
      <select name="tipeunit" class="form-control select2" style="width: 100%;">
        @foreach($tipe_unit as $tipe_units)
        <option value="{{$tipe_units->id_tipe}}">{{$tipe_units->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Tower</label>
      <select name="tower" class="form-control select2" style="width: 100%;">
        @foreach($tower as $towers)
          <option value="{{$towers->id_tower}}">{{$towers->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Arah</label>
      <select name="arah" class="form-control select2" style="width: 100%;">
        @foreach($arah_unit as $arah_units)
          <option value="{{$arah_units->id_arah}}">{{$arah_units->pemandangan}}</option>
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
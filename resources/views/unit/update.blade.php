@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('units.update',$unit)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="namaunit">Unit</label>
      <input type="text" class="form-control" id="namaunit" placeholder="Isi Unit" name="namaunit" value="{{$unit->no_unit}}"> 
    </div>
    <div class="form-group">
      <label>Status</label>
      <div class="custom-control custom-radio">
        @if($unit->status == 'terjual')
        <input class="custom-control-input" type="radio" id="terjual" name="customRadio" value="terjual" checked>
        @else
        <input class="custom-control-input" type="radio" id="terjual" name="customRadio" value="terjual">
        @endif
        <label for="terjual" class="custom-control-label">Terjual</label>
      </div>
      <div class="custom-control custom-radio">
        @if($unit->status == 'tersedia')
        <input class="custom-control-input" type="radio" id="tersedia" name="customRadio" value="tersedia" checked>
        @else
        <input class="custom-control-input" type="radio" id="tersedia" name="customRadio" value="tersedia">
        @endif
        <label for="tersedia" class="custom-control-label">Tersedia</label>
      </div>
      <div class="custom-control custom-radio">
        @if($unit->status == 'booking')
        <input class="custom-control-input" type="radio" id="terbooking" name="customRadio" value="booking" checked>
        @else
        <input class="custom-control-input" type="radio" id="terbooking" name="customRadio" value="booking">
        @endif
        <label for="terbooking" class="custom-control-label">Terbooking</label>
      </div>
    </div>
    <div class="form-group">
      <label for="lantai">Lantai</label>
      <input type="text" class="form-control" id="lantai" placeholder="Isi Lantai" name="lantai" value="{{$unit->lantai}}">
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
@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('hargajuals.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="hargajual">Harga Jual</label>
      <!-- <input type="number" class="form-control" id="hargajual" placeholder="Isi harga jual" name="hargajual" min="0" required> -->
      <input type="text" class="form-control" id="hargajual" placeholder="Isi harga jual" name="hargajual" min="0" required onchange="NumericInput(this)">
    </div>
    <div class="form-group">
      <label>Tanggal Awal:</label>
      <div class="input-group date" id="tglawal" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tglawal" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Tanggal Akhir:</label>
      <div class="input-group date" id="tglakhir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input pilihtanggal" name="tglakhir" data-target=".pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Tipe</label>
      <select name="tipeunit" class="form-control select2" style="width: 100%;" required>
        @foreach($tipe_unit as $tipe_units)
          <option value="{{$tipe_units->id_tipe}}">{{$tipe_units->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Tower</label>
      <select name="tower" class="form-control select2" style="width: 100%;" required>
        @foreach($tower as $towers)
          <option value="{{$towers->id_tower}}">{{$towers->nama}}</option>
          <option value="{{$towers->id_tower}}">{{$towers->lokasi}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <div class="form-group">
        <label>Arah</label>
        <select name="arah" class="form-control select2" style="width: 100%;" required>
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
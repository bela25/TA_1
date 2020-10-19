@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('hargajuals.update',$hargaJual)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="hargajual">Harga Jual</label>
      <input type="number" class="form-control" id="hargajual" placeholder="Isi harga jual" name="hargajual" value="{{$hargaJual->hargajual_cash}}" min="0" required>
    </div>
    <div class="form-group">
      <label>Tanggal Awal:</label>
      <div class="input-group date" id="tglawal" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tglawal" value="{{$hargaJual->tgl_awal}}" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Tanggal Akhir:</label>
      <div class="input-group date" id="tglakhir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tglakhir" value="{{$hargaJual->tgl_akhir}}" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Tipe</label>
      <select name="tipeunit" class="form-control select2" style="width: 100%;" required>
        @foreach($tipe_unit as $tipe_units)
          @if($tipe_units->id_tipe == $hargaJual->tipe)
          <option value="{{$tipe_units->id_tipe}}" selected>{{$tipe_units->nama}}</option>
          @else
          <option value="{{$tipe_units->id_tipe}}">{{$tipe_units->nama}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Tower</label>
      <select name="tower" class="form-control select2" style="width: 100%;" required>
        @foreach($tower as $towers)
          @if($towers->id_tower == $hargaJual->tower)
          <option value="{{$towers->id_tower}}" selected>{{$towers->nama}}</option>
          @else
          <option value="{{$towers->id_tower}}">{{$towers->nama}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <div class="form-group">
        <label>Arah</label>
        <select name="arah" class="form-control select2" style="width: 100%;" required>
          @foreach($arah_unit as $arah_units)
            @if($arah_units->id_arah == $hargaJual->arah)
            <option value="{{$arah_units->id_arah}}" selected>{{$arah_units->pemandangan}}</option>
            @else
            <option value="{{$arah_units->id_arah}}">{{$arah_units->pemandangan}}</option>
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
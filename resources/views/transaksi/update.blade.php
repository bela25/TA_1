@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('transaksis.update',$transaksi)}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Customer</label>
      <select name="customer" class="form-control select2" style="width: 100%;">
        @foreach($customer as $customers)
          <option value="{{$customers->idcustomers}}">{{$customers->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Unit</label>
      <select name="unit" class="form-control select2" style="width: 100%;">
        @foreach($unit as $units)
          <option value="{{$units->idunit}}">{{$units->no_unit}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Harga Jual</label>
      <select name="hargajual" class="form-control select2" style="width: 100%;">
        @foreach($harga_jual as $harga_juals)
          <option value="{{$harga_juals->idhargajual}}">{{$harga_juals->hargajual_cash}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Jenis Bayar</label>
      <select class="form-control"  name="jenisbayar" >
        <option>KPA</option>
        <option>Lunas</option>
        <option>In House</option>
        <option>Cash Keras</option>
      </select>
    </div>
    <div class="form-group">
      <label>Tanggal Pembayaran:</label>

      <div class="input-group date" id="tglpembayaran" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir">
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Status</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="aktif" name="customRadio" value="aktif">
        <label for="aktif" class="custom-control-label">Aktif</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="tidakaktif" name="customRadio" value="tidakaktif">
        <label for="tidakaktif" class="custom-control-label">Tidak Aktif</label>
      </div>
    </div>
    <div class="form-group">
      <label>Verifikasi</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="diterima" name="customRadio1" value="diterima">
        <label for="diterima" class="custom-control-label">Diterima</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="belumditerima" name="customRadio1" value="belumditerima">
        <label for="belumditerima" class="custom-control-label">Belum Diterima</label>
      </div>
    </div>
    <div class="form-group">
      <label>Tanggal Pelunasan:</label>

      <div class="input-group date" id="tglpelunasan" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir">
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  
</form>
@endsection
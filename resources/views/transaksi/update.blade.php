@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('transaksis.update',$transaksi)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label>Customer</label>
      <input type="text" name="customer_name" value="{{$transaksi->customers->nama}}" class="form-control" readonly>
      <input type="hidden" name="customer" value="{{$transaksi->customer}}">
      <!-- <select name="customer" class="form-control select2" style="width: 100%;" required>
        @foreach($customers as $customer)
          @if($customer->idcustomers == $transaksi->customer)
          <option value="{{$customer->idcustomers}}" selected>{{$customer->nama}}</option>
          @else
          <option value="{{$customer->idcustomers}}">{{$customer->nama}}</option>
          @endif
        @endforeach
      </select> -->
    </div>
    <div class="form-group">
      <label>Unit</label>
      <input type="text" name="unit_name" value="{{$transaksi->units->nama()}}" class="form-control" readonly>
      <input type="hidden" name="unit" value="{{$transaksi->unit}}">
      <!-- <select name="unit" class="form-control select2" style="width: 100%;" required>
        @foreach($units as $unit)
          @if($unit->id_unit == $transaksi->unit)
          <option value="{{$unit->id_unit}}" selected>{{$unit->nama()}}</option>
          @else
          <option value="{{$unit->id_unit}}">{{$unit->nama()}}</option>
          @endif
        @endforeach
      </select> -->
    </div>
    <!-- <div class="form-group">
      <label>Jenis Bayar</label>
      <select class="form-control" name="jenisbayar" required>
        @foreach($jenisBayars as $jenisBayar)
        @if(strtolower($jenisBayar) == $transaksi->jenis_bayar)
        <option value="{{strtolower($jenisBayar)}}" selected>{{$jenisBayar}}</option>
        @else
        <option value="{{strtolower($jenisBayar)}}">{{$jenisBayar}}</option>
        @endif
        @endforeach
      </select>
    </div> -->
    <div class="form-group">
      <label>Status</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="aktif" name="status" value="aktif" required checked>
        <label for="aktif" class="custom-control-label">Aktif</label>
      </div>
      <div class="custom-control custom-radio">
        @if($transaksi->status == 'tidak aktif')
        <input class="custom-control-input" type="radio" id="tidakaktif" name="status" value="tidak aktif" required checked>
        @else
        <input class="custom-control-input" type="radio" id="tidakaktif" name="status" value="tidak aktif" required>
        @endif
        <label for="tidakaktif" class="custom-control-label">Tidak Aktif</label>
      </div>
    </div>
    <div class="form-group">
      <label>Verifikasi</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="diterima" name="verifikasi" value="diterima" required checked>
        <label for="diterima" class="custom-control-label">Diterima</label>
      </div>
      <div class="custom-control custom-radio">
        @if($transaksi->verifikasi == 'belum diterima')
        <input class="custom-control-input" type="radio" id="belumditerima" name="verifikasi" value="belum diterima" required checked>
        @else
        <input class="custom-control-input" type="radio" id="belumditerima" name="verifikasi" value="belum diterima" required>
        @endif
        <label for="belumditerima" class="custom-control-label">Belum Diterima</label>
      </div>
    </div>
    <!-- <div class="form-group">
      <label>Tanggal Pelunasan:</label>
      <div class="input-group date" id="tglpelunasan" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir" value="{{$transaksi->tgl_pelunasan}}">
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div> -->
    <div class="form-group">
      <label>Pegawai:</label>
      <input type="text" name="pegawai_name" value="{{$transaksi->pegawais->nama}}" class="form-control" readonly>
      <input type="hidden" name="pegawai" value="{{$transaksi->pegawai}}">
      <!-- <select name="pegawai" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawais as $pegawai)
          @if($pegawai->nip == $pegawai_nip)
          <option value="{{$pegawai->nip}}" selected>{{$pegawai->nama}}</option>
          @else
          <option value="{{$pegawai->nip}}">{{$pegawai->nama}}</option>
          @endif
        @endforeach
      </select> -->
    </div>
    <!-- /.card-body -->
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  
</form>
@endsection
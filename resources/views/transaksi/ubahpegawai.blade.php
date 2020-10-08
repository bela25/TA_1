@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('transaksis.update',$transaksi)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label>Customer</label>
      <input type="text" name="customer" class="form-control" value="{{$transaksi->customers->nama}}" readonly>
    </div>
    <div class="form-group">
      <label>Unit</label>
      <input type="text" name="unit" class="form-control" value="{{$transaksi->units->nama()}}" readonly>
    </div>
    <div class="form-group">
      <label>Harga Jual</label>
      <input type="text" name="hargajual" class="form-control" value="Rp{{$transaksi->units->hargaJual()}}" readonly>
    </div>
    <div class="form-group">
      <label>Jenis Bayar</label>
      <input type="text" name="jenisbayar" class="form-control" value="{{$transaksi->jenis_bayar}}" readonly>
    </div>
    <div class="form-group">
      <label>Status</label>
      <input type="text" name="status" class="form-control" value="{{$transaksi->status}}" readonly>
    </div>
    <div class="form-group">
      <label>Verifikasi</label>
      <input type="text" name="verifikasi" class="form-control" value="{{$transaksi->verifikasi}}" readonly>
    </div>
    <div class="form-group">
      <label>Pilih Pegawai:</label>
      <select name="pegawai" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawais as $pegawai)
          @if($pegawai->nip == $pegawai_nip)
          <option value="{{$pegawai->nip}}" selected>{{$pegawai->nama}}</option>
          @else
          <option value="{{$pegawai->nip}}">{{$pegawai->nama}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <!-- /.card-body -->
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  
</form>
@endsection
@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembatalans.update',$pembatalan)}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Customer</label>
      <input type="text" name="customer_name" class="form-control" value="{{ $transaksi->customers->nama }}" readonly>
      <input type="hidden" name="customer" value="{{ $transaksi->customers->idcustomers }}">
    </div>
    <div class="form-group">
      <label>Alasan</label>
      <textarea class="form-control" rows="3" placeholder="Enter ..." id="alasan" value="{{$pembatalan->alasan}}" required></textarea>
    </div>
    <div class="form-group">
      <label>Tanggal Pembatalan:</label>
      <div class="input-group date" id="tanggalbatal" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir" required value="{{ $pembatalan->tanggal_batal }}">
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="exampleInputFile">Upload Bukti</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" required>
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="">Upload</span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Tanggal Pengembalian:</label>

      <div class="input-group date" id="tglpengembalian" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir" required value="{{$pembatalan->tgl_pengembalian}}">
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Admin</label>
      <input type="text" name="admin_name" class="form-control" value="{{ $pegawai->nama }}" readonly>
      <input type="hidden" name="admin" value="{{ $pegawai->nip }}">
    </div>
  </div>
  
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
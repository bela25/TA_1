@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembatalans.update',$pembatalan)}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Customer</label>
      <select name="customer" class="form-control select2" style="width: 100%;" required>
        @foreach($transaksi as $transaksis)
        <option value="{{$transaksis->id_transaksi}}">{{$transaksis->customer}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Alasan</label>
      <textarea class="form-control" rows="3" placeholder="Enter ..." id="alasan" value="{{$pembatalan->alasan}}" required></textarea>
    </div>
    <div class="form-group">
      <label>Tanggal Pembatalan:</label>
      <div class="input-group date" id="tanggalbatal" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir" required>
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
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Admin</label>
      <select name="admin" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawai as $pegawais)
        <option value="{{$pegawais->nip}}">{{$pegawais->nama}}</option>
        @endforeach
      </select>
    </div>
  </div>
  
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
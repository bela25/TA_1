@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembayaran_dps.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Customer</label>
      <select name="customer" class="form-control select2" style="width: 100%;">
        @foreach($customers as $customerss)
        <option value="{{$customers->id_customers}}">{{$customers->nama}}</option>
        @endforeach
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
      <!-- /.input group -->
    </div>
    <div class="form-group">
      <label>Nominal</label>
      <select class="form-control"  name="nominal" >
        <option>100jt</option>
        <option>200jt</option>
        <option>300jt</option>
        <option>400jt</option>
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputFile">Upload Bukti</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile">
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="">Upload</span>
        </div>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  @endsection
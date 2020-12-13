@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembayaran_dps.update',$pembayaran_dp)}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Customer</label>
      <select name="customer" class="form-control select2" style="width: 100%;" required>
        @foreach($customers as $customerss)
        <option value="{{$customers->id_customers}}">{{$customers->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Tanggal Pembayaran:</label>
      <div class="input-group date" id="tglpembayaran" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tglpembayaran" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      <!-- /.input group -->
    </div>
    <div class="form-group">
      <label>Nominal</label>
      <select class="form-control" name="nominal" required>
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
          <input type="file" class="custom-file-input" id="exampleInputFile" required>
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
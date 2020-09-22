@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembayaran_cicilans.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Kode Cicilan</label>
      <select name="kodecicilan" class="form-control select2" style="width: 100%;" required>
        @foreach($cicilan as $cicilans)
          <option value="{{$cicilans->id_cicilan}}">{{$cicilans->id_cicilan}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Tanggal Pembayaran:</label>

      <div class="input-group date" id="tglpembayaran" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tgllahir" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      <!-- /.input group -->
    </div>
    <div class="form-group">
      <label>Nominal</label>
      <select class="form-control"  name="nominal" required>
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
@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('cicilans.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Transaksi</label>
      <select name="transaksi" class="form-control select2" style="width: 100%;">
        @foreach($transaksi as $transaksis)
          <option value="{{$transaksis->id_transaksi}}">{{$transaksis->nama()}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Tanggal Awal:</label>

      <div class="input-group date" id="tanggal_mulai" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tanggal_mulai" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      <!-- /.input group -->
    </div>
    <div class="form-group">
      <label>Tanggal Akhir:</label>

      <div class="input-group date" id="tanggal_akhir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input pilihtanggal" name="tanggal_akhir" data-target=".pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      <!-- /.input group -->
    </div>
    <div class="form-group">
      <label for="bunga">Bunga</label>
      <input type="number" class="form-control" id="bunga" placeholder="Isi Bunga" name="bunga" min="0" step="0.01" required>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
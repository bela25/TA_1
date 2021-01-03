@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('beritas.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Lokasi</label>
      <input type="text" class="form-control" id="namalokasi" name="namalokasi" value="{{ $lokasi->nama_apartemen }}" required readonly>
      <input type="hidden" class="form-control" id="lokasi" name="lokasi" value="{{ $lokasi->idlokasi }}" required>
      <!-- <select name="lokasi" class="form-control select2" style="width: 100%;" required>
        @foreach($lokasis as $lokasi)
          <option value="{{$lokasi->idlokasi}}">{{$lokasi->nama_apartemen}}</option>
        @endforeach
      </select> -->
    </div>
    <div class="form-group">
      <label for="progress">Progress</label>
      <input type="text" class="form-control" id="progress" placeholder="Isi Progress" name="progress" required>
    </div>
    <div class="form-group">
      <label>Tanggal</label>
      <div class="input-group date" id="tanggal" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tanggal" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
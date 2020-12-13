@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('feedbacks.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="tglawal">Tanggal Feedback</label>
      <div class="input-group date" id="tanggal_feedback" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tanggal_feedback" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Lokasi</label>
      <select name="lokasi" class="form-control select2" style="width: 100%;" required>
        @foreach($lokasis as $lokasi)
          <option value="{{$lokasi->idlokasi}}">{{$lokasi->nama_apartemen}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Pegawai</label>
      <select name="pegawai" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawais as $pegawai)
          <option value="{{$pegawai->nip}}">{{$pegawai->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Customer</label>
      <select name="customer" class="form-control select2" style="width: 100%;" required>
        @foreach($customers as $customer)
          <option value="{{$customer->idcustomers}}">{{$customer->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="isi">Isi</label>
      <textarea class="form-control" rows="5" placeholder="Isi ..." id="isi" name="isi" required></textarea>
    </div>
    <div class="form-group">
      <label>Reply</label>
      <textarea class="form-control" rows="3" placeholder="Reply ..." id="reply" name="reply" required></textarea>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
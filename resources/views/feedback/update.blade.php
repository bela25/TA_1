@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('feedbacks.update', $feedback)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="tglawal">Tanggal Feedback</label>
      <div class="input-group date" id="tanggal_feedback" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tanggal_feedback" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required value="{{ $feedback->tanggal_feedback }}">
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Lokasi</label>
      <select name="lokasi" class="form-control select2" style="width: 100%;" required>
        @foreach($lokasis as $lokasi)
          @if($feedback->lokasi == $lokasi->idlokasi)
          <option value="{{$lokasi->idlokasi}}" selected>{{$lokasi->nama_apartemen}}</option> 
          @else
          <option value="{{$lokasi->idlokasi}}">{{$lokasi->nama_apartemen}}</option> 
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Pegawai</label>
      <select name="pegawai" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawais as $pegawai)
          @if($feedback->pegawai == $pegawai->nip)
          <option value="{{$pegawai->nip}}" selected>{{$pegawai->nama}}</option>
          @else
          <option value="{{$pegawai->nip}}">{{$pegawai->nama}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Customer</label>
      <select name="customer" class="form-control select2" style="width: 100%;" required>
        @foreach($customers as $customer)
          @if($feedback->customer == $customer->idcustomers)
          <option value="{{$customer->idcustomers}}" selected>{{$customer->nama}}</option>
          @else
          <option value="{{$customer->idcustomers}}">{{$customer->nama}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="isi">Isi</label>
      <textarea class="form-control" rows="5" placeholder="Isi ..." id="isi" name="isi" required>{{$feedback->isi}}</textarea>
    </div>
    <div class="form-group">
      <label>Reply</label>
      <textarea class="form-control" rows="3" placeholder="Reply ..." id="reply" name="reply" required>{{$feedback->reply}}</textarea>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
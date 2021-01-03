@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('beritas.update', $berita)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label>Lokasi</label>
      <input type="text" class="form-control" id="namalokasi" name="namalokasi" value="{{ $lokasi->nama_apartemen }}" required readonly>
      <input type="hidden" class="form-control" id="lokasi" name="lokasi" value="{{ $lokasi->idlokasi }}" required>
    </div>
    <div class="form-group">
      <label for="progress">Progress</label>
      <input type="text" class="form-control" id="progress" placeholder="Isi Progress" name="progress" value="{{$berita->progress}}" required>
    </div>
    <div class="form-group">
      <label>Tanggal</label>
      <div class="input-group date" id="tanggal" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tanggal" id="pilihtanggal" value="{{$berita->tanggal}}" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
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
@push('scripts')
<script>
  $('#pilihtanggal').datetimepicker({
    format: 'Y-MM-DD',
    date: moment('{{ $berita->tanggal }}') 
  });
</script>
@endpush
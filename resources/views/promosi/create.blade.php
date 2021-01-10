@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('promosis.store')}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="judulpromosi">Judul Promosi</label>
      <input type="text" class="form-control" id="judulpromosi" placeholder="Isi Judul Promosi" name="judulpromosi" required>
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea class="form-control" rows="3" placeholder="Keterangan ..." id="keterangan" name="keterangan" required></textarea>
    </div>
    <div class="form-group">
      <label for="tglawal">Tanggal Awal</label>
      <div class="input-group date" id="tglawal" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tglawal" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="tglakhir">Tanggal Akhir</label>
      <div class="input-group date" id="tglakhir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input pilihtanggal" name="tglakhir" data-target=".pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
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
    <div class="form-group">
      <label>Lokasi</label>
      <select name="lokasi" class="form-control select2" style="width: 100%;" required>
        @foreach($lokasi as $lokasis)
          <option value="{{$lokasis->idlokasi}}">{{$lokasis->nama_apartemen}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputFile">Gambar</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar" required onchange="readURL(this)">
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="">Upload</span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <img id="tampilangambar" src="#" alt="Gambar">
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
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#tampilangambar')
                  .attr('src', e.target.result)
                  .width('auto')
                  .height(400);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>
@endpush
@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('profils.update',$profil)}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <!-- <div class="from-group">
      <label for="tgldibuat">Tanggal Dibuat</label>
      <div class="input-group">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" id="tgldibuat" placeholder="Isi Tanggal Dibuat" name="tgldibuat" value="{{date('Y-m-d')}}" required readonly>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div> -->
    <div class="form-group">
      <label>Admin</label>
      <input type="text" class="form-control" id="admin" name="admin" value="{{$profil->pegawais->nama}}" required readonly>
      <!-- <select name="admin" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawai as $pegawais)
          <option value="{{$pegawais->nip}}">{{$pegawais->nama}}</option>
        @endforeach
      </select> -->
    </div>
    <div class="form-group">
      <label for="judulprofil">Judul Profil</label>
      <input type="text" class="form-control" id="judulprofil" placeholder="Isi Judul Profil" name="judulprofil" value="{{$profil->judul_profil}}" required>
    </div>
    <div class="form-group">
      <label>Keterangan</label>
      <textarea class="form-control" rows="3" placeholder="Keterangan ..." id="keterangan" name="keterangan" required>{{$profil->keterangan}}</textarea>
    </div>
  <!--  <div class="from-group">
      <label for="exampleInputFile">Gambar</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar" onchange="readURL(this)">
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="">Upload</span>
        </div>-->
      </div>
    </div>
    <!-- <div class="form-group">
      <img id="tampilangambar" src="{{$profil->gambar}}" alt="Gambar">
    </div> -->
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
@push('scripts')
<script>
  $('#pilihtanggal1').datetimepicker({
    defaultDate: moment(), 
    format: 'DD-MM-YYYY', 
  });
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
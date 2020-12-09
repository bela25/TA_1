@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('gambar_produks.store')}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="exampleInputFile">Gambar</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" name="file_gambar" onchange="readURL(this)" required>
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="">Upload</span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Tipe</label>
      <select name="tipe" class="form-control select2" style="width: 100%;" required>
        @foreach($tipe_unit as $tipe_units)
          <option value="{{$tipe_units->id_tipe}}">{{$tipe_units->nama}}</option>
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
    <img id="tampilangambar" src="#" alt="tampilan gambar"/>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
@push('scripts')
<script type="text/javascript">
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#tampilangambar')
                  .attr('src', e.target.result)
                  .width('auto')
                  .height(200);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>
@endpush
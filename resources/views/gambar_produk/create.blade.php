@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('gambar_produks.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="exampleInputFile">Gambar</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile">
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
          <span class="input-group-text" id="">Upload</span>
        </div>
      </div>
    </div>
      <div class="form-group">
        <label>Tipe</label>
        <select name="tipe" class="form-control select2" style="width: 100%;">
          @foreach($tipe_unit as $tipe_units)
          <option value="{{$tipe_units->id_tipe}}">{{$tipe_units->nama}}</option>
          @endforeach
        </select>
      </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
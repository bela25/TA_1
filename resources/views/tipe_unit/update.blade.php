@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('tipe_units.update',$tipe_unit)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="namatipe">Nama Tipe</label>
      <input type="text" class="form-control" id="namatipe" placeholder="Isi Nama Tipe" name="namatipe" value="{{$tipe_unit->nama}}" required>
    </div>
    <div class="form-group">
      <label for="fasilitas">Fasilitas</label>
      <input type="text" class="form-control" id="fasilitas" placeholder="Isi Fasilitas" name="fasilitas"value="{{$tipe_unit->fasilitas}}" required>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
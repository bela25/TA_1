@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('tipe_units.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="namatipe">Nama Tipe</label>
      <input type="text" class="form-control" id="namatipe" placeholder="Isi Nama Tipe" name="namatipe" required>
    </div>
    <div class="form-group">
      <label for="fasilitas">Fasilitas</label>
      <input type="text" class="form-control" id="fasilitas" placeholder="Isi Fasilitas" name="fasilitas" required>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
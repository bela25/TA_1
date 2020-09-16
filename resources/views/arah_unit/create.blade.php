@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('arah_units.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="pemandangan">Pemandangan</label>
      <input type="text" class="form-control" id="pemandangan" placeholder="Isi Pemandangan" name="pemandangan"> 
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection
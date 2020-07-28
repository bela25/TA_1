@extends('layouts.master')

@section('content')
<!-- form start -->
              <form role="form" action="{{route('arah_units.update',$arah_unit)}}" method="post">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="pemandangan">Pemandangan</label>
                    <input type="text" class="form-control" id="pemandangan" placeholder="Isi Nama" name="pemandangan" value="{{$arah_unit->nama_apartemen}}">
                     
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
@endsection
@extends('layouts.master')

@section('content')
<!-- form start -->
              <form role="form" action="{{route('lokasis.store')}}" method="post">
                {{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaapartemen">Nama Apartemen</label>
                    <input type="text" class="form-control" id="namaapartemen" placeholder="Isi Nama" name="namaapartemen">
                     <label for="namaprovinsi">Provinsi</label>
                    <input type="text" class="form-control" id="namaprovinsi" placeholder="Isi Nama" name="namaprovinsi">
                     <label for="namakota">Kota</label>
                    <input type="text" class="form-control" id="namakota" placeholder="Isi Nama" name="namakota">
                     <label for="namaalamat">Alamat</label>
                    <input type="text" class="form-control" id="namaalamat" placeholder="Isi Nama" name="namaalamat">
                     
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
@endsection
@extends('layouts.master')

@section('content')
<!-- form start -->
              <form role="form" action="{{route('spesifikasi_bangunans.store')}}" method="post">
              	{{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="lantai">Lantai</label>
                    <input type="text" class="form-control" id="lantai" placeholder="Isi lantai" name="lantai">
                    <label for="dinding">Dinding</label>
                    <input type="text" class="form-control" id="dinding" placeholder="Isi Nama" name="dinding">
                    <label for="platfon">Platfon</label>
                    <input type="text" class="form-control" id="platfon" placeholder="Isi Nama" name="platfon">
                     <label for="instalasilistrik">Instalasi Listrik</label>
                    <input type="text" class="form-control" id="instalasilistrik" placeholder="Isi Nama" name="instalasilistrik">
                     <label for="sanitary">Sanitary</label>
                    <input type="text" class="form-control" id="sanitary" placeholder="Isi Nama" name="sanitary">
                    <label for="pintu">Pintu</label>
                    <input type="text" class="form-control" id="pintu" placeholder="Isi Nama" name="pintu">
                    <label for="jendela">Jendela</label>
                    <input type="text" class="form-control" id="jendela" placeholder="Isi Nama" name="jendela">
                     <label for="air">Air</label>
                    <input type="text" class="form-control" id="air" placeholder="Isi Nama" name="air">
                    <div class="form-group">
                    <label>Admin</label>
                    <select name="admin" class="form-control select2" style="width: 100%;">
                      @foreach($pegawai as $pegawais)
                    <option value="{{$pegawais->nip}}">{{$pegawais->nama}}</option>
                    @endforeach
                  </select>
                </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
@endsection
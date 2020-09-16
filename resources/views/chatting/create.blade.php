@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('chattings.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label for="pesan">Pesan</label>
      <input type="text" class="form-control" id="pesan" placeholder="Isi Nama" name="pesan">
    </div>
    <div class="form-group">
      <label for="tglpesan">Tgl Pesan</label>
      <input type="text" class="form-control" id="tglpesan" placeholder="Isi Nama" name="tglpesan">
    </div>      
    <div class="form-group">
      <label>Customer</label>
      <select name="customer" class="form-control select2" style="width: 100%;">
        @foreach($customer as $customers)
          <option value="{{$customers->idcustomers}}">{{$customers->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Admin</label>
      <select name="admin" class="form-control select2" style="width: 100%;">
        @foreach($pegawai as $pegawais)
          <option value="{{$pegawais->nip}}">{{$pegawais->nama}}</option>
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
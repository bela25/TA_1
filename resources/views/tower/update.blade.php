 @extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('towers.update',$tower)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" value="{{$tower->nama}}" required>
    </div>
    <div class="form-group">
      <label for="keterangan">Keterangan</label>
      <input type="text" class="form-control" id="keterangan" placeholder="Isi Keterangan" name="keterangan" value="{{$tower->keterangan}}" required>
    </div>
    <div class="form-group">
      <label>Lokasi</label>
      <select name="lokasi" class="form-control select2" style="width: 100%;" required>
        @foreach($lokasi as $lokasis)
          <option value="{{$lokasis->idlokasi}}">{{$lokasis->nama_apartemen}}</option>
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

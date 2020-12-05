@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembatalans.update',$pembatalan)}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label>Customer</label>
      <input type="text" name="customer" class="form-control" value="{{$pembatalan->transaksis->customers->nama}}" readonly>
    </div>
    <div class="form-group">
      <label>Unit</label>
      <input type="text" name="unit" class="form-control" value="{{$pembatalan->transaksis->units->nama()}}" readonly>
    </div>
    <div class="form-group">
      <label>Tanggal Pembatalan</label>
      <input type="text" name="tanggal_batal" class="form-control" value="{{$pembatalan->tanggal_batal}}" readonly>
    </div>
    <div class="form-group">
      <label>Tanggal Pengembalian</label>
      <input type="text" name="tglpengembalian" class="form-control" value="{{$pembatalan->tgl_pengembalian}}" readonly>
    </div>
    <div class="form-group">
      <label>Alasan</label>
      <textarea class="form-control" rows="3" placeholder="Enter ..." name="alasan" value="{{$pembatalan->alasan}}" required readonly>{{$pembatalan->alasan}}</textarea>
    </div>
    <div class="form-group">
      <label>Admin</label>
      <input type="text" name="admin_name" class="form-control" value="{{$pembatalan->pegawais->nama}}" readonly>
      <input type="hidden" name="admin" value="{{$pembatalan->pegawais->nip}}">
      <!-- <select name="admin" class="form-control select2" style="width: 100%;" required>
        @foreach($pegawais as $pegawai)
          @if($pegawai->nip == $pegawai_nip)
          <option value="{{$pegawai->nip}}" selected>{{$pegawai->nama}}</option>
          @else
          <option value="{{$pegawai->nip}}">{{$pegawai->nama}}</option>
          @endif
        @endforeach
      </select> -->
    </div>
    <div class="form-group">
      <label for="exampleInputFile">Upload Bukti</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" name="bukti" required onchange="readURL(this)">
          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
      </div>
    </div>
    <img id="tampilangambar" src="{{asset($pembatalan->gambar_bukti)}}" alt="tampilan gambar" height="200" />
  </div>
  
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
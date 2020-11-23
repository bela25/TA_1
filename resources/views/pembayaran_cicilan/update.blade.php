@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembayaran_cicilans.update',$pembayaranCicilan)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <div class="form-group">
      <label>Kode Cicilan</label>
      <input type="text" class="form-control" id="cicilan_ke" placeholder="Isi cicilan ke" name="cicilan_ke" value="{{$pembayaranCicilan->cicilan}}" required readonly>
      <!-- <select name="kodecicilan" class="form-control select2" style="width: 100%;" required>
        @foreach($cicilan as $cicilans)
          @if($cicilans->id_cicilan == $pembayaranCicilan->cicilan)
            <option value="{{$cicilans->id_cicilan}}" selected>{{$cicilans->id_cicilan}}</option>
          @else
            <option value="{{$cicilans->id_cicilan}}">{{$cicilans->id_cicilan}}</option>
          @endif
        @endforeach
      </select> -->
    </div>
    <div class="form-group">
      <label for="cicilan_ke">Cicilan ke-</label>
      <input type="number" class="form-control" id="cicilan_ke" placeholder="Isi cicilan ke" name="cicilan_ke" min="0" step="1" value="{{$pembayaranCicilan->cicilan_ke}}" required readonly>
    </div>
    <div class="form-group">
      <label>Nominal</label>
      <input type="number" class="form-control" placeholder="Isi nominal" name="nominal" min="0" step="100000000" value="{{$pembayaranCicilan->nominal}}" required>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  @endsection
@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembayaran_cicilans.update',$pembayaranCicilan)}}" method="post">
  {{csrf_field()}}
  {{method_field('put')}}
  <div class="card-body">
    <input type="hidden" name="transaksi" value="{{$pembayaranCicilan->cicilans->transaksis->id_transaksi}}">
    <div class="form-group">
      <label>Transaksi</label>
      <input type="text" name="transaksi_name" value="{{$pembayaranCicilan->cicilans->transaksis->nama()}}" class="form-control" readonly>
    </div>
    <!-- <div class="form-group">
      <label>Kode Cicilan</label>
      <input type="text" class="form-control" id="kodecicilan" placeholder="Isi cicilan ke" name="kodecicilan" value="{{$pembayaranCicilan->cicilan}}" required readonly>
    </div> -->
    <div class="form-group">
      <label for="cicilan_ke">Cicilan ke-</label>
      <input type="number" class="form-control" id="cicilan_ke" placeholder="Isi cicilan ke" name="cicilan_ke" min="0" step="1" value="{{$pembayaranCicilan->cicilan_ke}}" required readonly>
    </div>
    <div class="form-group">
      <label>Nominal</label>
      <input type="number" class="form-control" placeholder="Isi nominal" name="nominal" min="0" value="{{$pembayaranCicilan->nominal}}" required onchange="NumericInput(this); cekTotalCicilan();">
    </div>
    <div class="form-group">
      <label>Tenggat Waktu</label>
      <div class="input-group date" id="tenggat_waktu" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input pilihtanggal" name="tenggat_waktu" data-target=".pilihtanggal" data-toggle="datetimepicker" required value="{{ $pembayaranCicilan->tenggat_waktu }}">
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      <!-- /.input group -->
    </div>
    <div class="form-group">
      <label>Cicilan Terakhir</label>
      <div class="custom-control custom-radio">
        @if($pembayaranCicilan->cicilan_terakhir == 'iya')
        <input class="custom-control-input" type="radio" id="iya" name="cicilan_terakhir" value="iya" checked>
        @else
        <input class="custom-control-input" type="radio" id="iya" name="cicilan_terakhir" value="iya">
        @endif
        <label for="iya" class="custom-control-label">Iya</label>
      </div>
      <div class="custom-control custom-radio">
        @if($pembayaranCicilan->cicilan_terakhir == 'tidak')
        <input class="custom-control-input" type="radio" id="tidak" name="cicilan_terakhir" value="tidak" checked onclick="cekTotalCicilan()">
        @else
        <input class="custom-control-input" type="radio" id="tidak" name="cicilan_terakhir" value="tidak" onclick="cekTotalCicilan()">
        @endif
        <label for="tidak" class="custom-control-label">Tidak</label>
      </div>
      <div class="cekTotalCicilan d-none">
        <div class="alert alert-warning" role="alert">
          <span class="pesan"></span>
        </div>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  @endsection

  @push('scripts')
    <script type="text/javascript">
      function cekTotalCicilan(){
        var value = $("input[name=cicilan_terakhir]:checked").val();
        var nominal = $("input[name=nominal]").val();
        @if($pembayaranCicilan->cicilans != null)
        var selisih = '{{ $pembayaranCicilan->cicilans->totalSesuaiHarga() }}';
        @else
        var selisih = '{{ $pembayaranCicilan->cicilanYangHarusDibayar() }}';
        @endif
        // console.log(value,nominal,number_format(selisih));
        if(value == 'iya'){
          if(nominal < selisih){
            $('.cekTotalCicilan').removeClass('d-none');
            $('.pesan').html('Total cicilan belum mencapai harga yang belum dibayarkan. Ganti nominal cicilan terakhir menjadi: Rp '+(selisih));
            // $('.submit').prop('disabled',true);
          }
          else if(nominal > selisih){
            $('.cekTotalCicilan').removeClass('d-none');
            $('.pesan').html('Total cicilan telah melewati harga yang belum dibayarkan. Ganti nominal cicilan terakhir menjadi: Rp '+(selisih));
            // $('.submit').prop('disabled',true);
          }
          else{
            $('.cekTotalCicilan').addClass('d-none');
            $('.pesan').html('Total cicilan sudah sesuai harga yang belum dibayarkan.');
            // $('.submit').prop('disabled',false);
          }
        }
        else{
          $('.cekTotalCicilan').addClass('d-none');
          $('.pesan').html('Total cicilan sudah sesuai harga yang belum dibayarkan.');
          // $('.submit').prop('disabled',false);
        }
      }
    </script>
  @endpush
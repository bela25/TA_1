@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembayaran_cicilans.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <input type="hidden" name="transaksi" value="{{$transaksi->id_transaksi}}">
    <div class="form-group">
      <label>Transaksi</label>
      <input type="text" name="transaksi_name" value="{{$transaksi->nama()}}" class="form-control" readonly>
    </div>
    @if($transaksi->cicilans == null)
    <div class="form-group">
      <label>Tanggal Awal</label>

      <div class="input-group date" id="tglawal" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" name="tanggal_mulai" id="pilihtanggal" data-target="#pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      <!-- /.input group -->
    </div>
    <!-- <div class="form-group">
      <label>Tanggal Akhir:</label>

      <div class="input-group date" id="tglakhir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tanggal_akhir" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
    </div> -->
    <div class="form-group">
      <label for="bunga">Bunga</label>
      <input type="number" class="form-control" id="bunga" placeholder="Isi Bunga" name="bunga" min="0" step="0.01" required>
    </div>
    @else
    <!-- <div class="form-group">
      <label>Kode Cicilan</label>
      <select name="kodecicilan" class="form-control select2" style="width: 100%;" required>
        @foreach($cicilan as $cicilans)
          <option value="{{$cicilans->id_cicilan}}">{{$cicilans->id_cicilan}}</option>
        @endforeach
      </select>
    </div> -->
    @endif
    <div class="form-group">
      <label for="cicilan_ke">Cicilan ke-</label>
      <input type="number" class="form-control" id="cicilan_ke" placeholder="Isi cicilan ke" name="cicilan_ke" min="0" step="1" required>
    </div>
    <div class="form-group">
      <label>Nominal</label>
      <!-- <input type="number" class="form-control" placeholder="Isi nominal" name="nominal" min="1000000" required> -->
      <input type="text" class="form-control" placeholder="Isi nominal" name="nominal" required onchange="NumericInput(this); cekTotalCicilan();">
    </div>
    <div class="form-group">
      <label>Tenggat Waktu</label>

      <div class="input-group date" id="tglakhir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input pilihtanggal" name="tenggat_waktu" data-target=".pilihtanggal" data-toggle="datetimepicker" required>
        <div class="input-group-append">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      <!-- /.input group -->
    </div>
    <div class="form-group">
      <label>Cicilan Terakhir</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="iya" name="cicilan_terakhir" value="iya" onclick="cekTotalCicilan()">
        <label for="iya" class="custom-control-label">Iya</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="tidak" name="cicilan_terakhir" value="tidak" checked onclick="cekTotalCicilan()">
        <label for="tidak" class="custom-control-label">Tidak</label>
      </div>
    </div>
    <div class="cekTotalCicilan d-none">
      <div class="alert alert-warning" role="alert">
        <span class="pesan"></span>
      </div>
    </div>
  </div>
  <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary submit">Submit</button>
    </div>
  </form>
  @endsection

  @push('scripts')
    <script type="text/javascript">
      function cekTotalCicilan(){
        var value = $("input[name=cicilan_terakhir]:checked").val();
        var nominal = $("input[name=nominal]").val();
        @if($transaksi->cicilans != null)
        var selisih = '{{ $transaksi->cicilans->totalSesuaiHarga() }}';
        @else
        var selisih = '{{ $transaksi->cicilanYangHarusDibayar() }}';
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
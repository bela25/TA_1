@extends('layouts.master')

@section('content')
<!-- form start -->
<form role="form" action="{{route('pembayaran_cicilans.store')}}" method="post">
  {{csrf_field()}}
  <div class="card-body">
    <div class="form-group">
      <label>Kode Cicilan</label>
      <select name="kodecicilan" class="form-control select2" style="width: 100%;" required>
        @foreach($cicilan as $cicilans)
          <option value="{{$cicilans->id_cicilan}}">{{$cicilans->id_cicilan}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="cicilan_ke">Cicilan ke-</label>
      <input type="number" class="form-control" id="cicilan_ke" placeholder="Isi cicilan ke" name="cicilan_ke" min="0" step="1" required>
    </div>
    <div class="form-group">
      <label>Nominal</label>
      <input type="number" class="form-control" placeholder="Isi nominal" name="nominal" min="0" step="100000000" required>
    </div>
    <div class="form-group">
      <label>Tenggat Waktu</label>

      <div class="input-group date" id="tglakhir" data-target-input="nearest">
        <input type="text" class="form-control datetimepicker-input" data-target="#tgllahir" name="tenggat_waktu" required>
        <div class="input-group-append" data-target="#tgllahir" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
      </div>
      <!-- /.input group -->
    </div>
    <div class="form-group">
      <label>Cicilan Terakhir</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="iya" name="cicilan_terakhir" value="iya">
        <label for="iya" class="custom-control-label">Iya</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="tidak" name="cicilan_terakhir" value="tidak" checked>
        <label for="tidak" class="custom-control-label">Tidak</label>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  @endsection
  @push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
  <script type="text/javascript">
    function NumericInput(inp, locale) {
      var numericKeys = '0123456789';

      // restricts input to numeric keys 0-9
      inp.addEventListener('keypress', function(e) {
        var event = e || window.event;
        var target = event.target;

        if (event.charCode == 0) {
          return;
        }

        if (-1 == numericKeys.indexOf(event.key)) {
          // Could notify the user that 0-9 is only acceptable input.
          event.preventDefault();
          return;
        }
      });

      // add the thousands separator when the user blurs
      inp.addEventListener('blur', function(e) {
        var event = e || window.event;
        var target = event.target;

        var tmp = target.value.replace(/,/g, '');
        var val = Number(tmp).toLocaleString(locale);

        if (tmp == '') {
          target.value = '';
        } else {
          target.value = val;
        }
      });

      // strip the thousands separator when the user puts the input in focus.
      inp.addEventListener('focus', function(e) {
        var event = e || window.event;
        var target = event.target;
        var val = target.value.replace(/[,.]/g, '');

        target.value = val;
      });
    }

    var number = new NumericInput(document.getElementById('demo'));
  </script>
  @endpush
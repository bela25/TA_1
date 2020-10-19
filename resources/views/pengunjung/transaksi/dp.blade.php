@extends('layouts.pengunjung')

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
        <h1 class="mb-3 bread">Properties DP</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Properties Booking<i class="ion-ios-arrow-forward"></i></span></p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-property-details">
  <div class="container">
  	<div class="row justify-content-center">
  		<div class="col-md-12">
  			<div class="property-details">
  				<div class="img rounded" style="background-image: url('{{asset('web/images/work-1.jpg')}}');"></div>
  					<div class="text float-left">
	  					<h2>{{$unit->tipes->nama}} No. {{$unit->no_unit}}</h2>
	  					<span class="subheading">Tower {{$unit->towers->nama}}</span>
	  					<p class="price d-inline"><span class="orig-price">Rp{{$unit->hargaJual()}}</span></p>
  					</div>
            <div class="float-right">
              <a href="{{route('pengunjung.booking',$unit)}}" class="btn btn-secondary py-3 px-5">Kembali</a>
            </div>
  			</div>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-12">
      @if(session('pesan'))
        <div class="alert alert-success mt-3" role="alert">
          {{session('pesan')}}
        </div>
      @endif
  		@if($unit->status == 'booking' && $transaksi->verifikasi == 'diterima' && $transaksi->jenis_bayar == null)
  			<form action="{{route('transaksis.update',$transaksi)}}" method="post" class="bg-light p-5 contact-form">
  				{{csrf_field()}}
          {{method_field('put')}}
          <h5>Pilih jenis bayar sebelum melakukan pembayaran DP</h5>
          <input type="hidden" name="unit" value="{{$unit->id_unit}}">
          <input type="hidden" name="status" value="{{$transaksi->status}}">
          <input type="hidden" name="verifikasi" value="{{$transaksi->verifikasi}}">
          <div class="form-group">
            <label>Customer</label>
            <input type="text" class="form-control" name="customer_nama" value="{{$customer->nama}}" readonly="true">
            <input type="hidden" class="form-control" name="customer" value="{{$customer->idcustomers}}">
          </div>
          <div class="form-group">
            <label>Jenis Bayar</label>
            <select class="form-control" name="jenisbayar" required>
              <option value="kpa">KPA</option>
              <option value="lunas">Lunas</option>
              <option value="in house">In House</option>
              <option value="cash keras">Cash Keras</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" value="Simpan" class="btn btn-primary py-3 px-5">
          </div>
        </form>
  		@endif
  		</div>
  		<div class="col-md-12 pills">
        @if($transaksi->jenis_bayar != null)
					<div class="bd-example bd-example-tabs">
						<div class="d-flex">
						  <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">

						    <li class="nav-item">
						      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Pembayaran DP</a>
						    </li>
						  </ul>
						</div>

					  <div class="tab-content" id="pills-tabContent">
					    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
					    	<div class="row">
					    		<div class="col-md-12">
					    			<p>Pembayaran DP dapat dikirim ke rekening bank BCA <strong>088xxxxxx</strong> a.n <strong>Nabila</strong></p>
                    <p>Harga Jual: <strong>Rp{{$unit->hargaJual()}}</strong></p>
                    <p>Nominal DP: <strong>Rp{{$unit->formatUang($unit->dp())}}</strong> (20% dari Harga Jual)</p>

                    @if($pembayaranDP == null)
  					    			<form action="{{route('pembayaran_dps.store')}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
  					    				{{csrf_field()}}
                        <input type="hidden" name="transaksi" value="{{$transaksi->id_transaksi}}">
                        <input type="hidden" name="nominal" value="{{$unit->dp()}}">
    					    			<h5>Upload bukti transfer jika sudah melakukan pembayaran</h5>
  						          <div class="form-group">
  				                <label>Bukti Transfer</label>
  				                <div class="custom-file">
  				                  <input type="file" class="custom-file-input" id="customFile" name="bukti" onchange="readURL(this)">
  				                  <label class="custom-file-label" for="customFile">Choose file</label>
  				                </div>
  				              </div>
  				              <div class="form-group">
  				              	<img id="tampilangambar" src="#" alt="Gambar bukti transfer">
  				              </div>
  				              <div class="form-group">
  				                <input type="submit" value="Upload" class="btn btn-primary py-3 px-5">
  				              </div>
  						        </form>
                    @else
                      <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> Anda sudah mengirim bukti pembayaran DP.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{route('pembayaran_dps.update',$pembayaranDP)}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="hidden" name="transaksi" value="{{$transaksi->id_transaksi}}">
                        <input type="hidden" name="nominal" value="{{$unit->dp()}}">
                        <h5>Ubah bukti transfer jika salah meng-upload gambar</h5>
                        <div class="form-group">
                          <label>Bukti Transfer</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="bukti" onchange="readURL(this)">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <img id="tampilangambar" src="{{asset($pembayaranDP->gambar_bukti)}}" alt="Gambar bukti transfer" height="400">
                        </div>
                        <div class="form-group">
                          <input type="submit" value="Upload" class="btn btn-primary py-3 px-5">
                        </div>
                      </form>
                    @endif
					    		</div>
					    	</div>
					    </div>
              <!-- tab-pande -->
					  </div>
            <!-- tab-content -->
					</div>
          <!-- bd -->
        @endif
      </div>
		</div>
  </div>
</section>
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
                  .height(400);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>
@endpush
@extends('layouts.pengunjung')

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
        <h1 class="mb-3 bread">Properties Booking</h1>
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
              @if($transaksi != null)
                <p>Verifikasi: 
                  @if($transaksi->verifikasi == 'belum diterima')
                  <span class="badge badge-warning">{{$transaksi->verifikasi}}</span>
                  @else
                  <span class="badge badge-success">{{$transaksi->verifikasi}}</span>
                  <p>Transaksi Anda telah diverifikasi. Silahkan melakukan pembayaran DP</p>
                  <a href="{{route('pengunjung.dp',$unit)}}" class="btn btn-primary py-3 px-5">Bayar DP</a>
                  @endif
                </p>
              @endif
  					</div>
            <div class="float-right">
              <a href="{{route('pengunjung.listing.single',$unit)}}" class="btn btn-secondary py-3 px-5">Kembali</a>
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
  		@if($unit->status == 'tersedia')
  			<form action="{{route('transaksis.store')}}" method="post" class="bg-light p-5 contact-form">
  				{{csrf_field()}}
          <input type="hidden" name="unit" value="{{$unit->id_unit}}">
          <div class="form-group">
            <label>Customer</label>
            <input type="text" class="form-control" name="customer_nama" value="{{$customer->nama}}" readonly="true">
            <input type="hidden" class="form-control" name="customer" value="{{$customer->idcustomers}}">
          </div>
          <div class="form-group">
            <input type="submit" value="Booking" class="btn btn-primary py-3 px-5">
          </div>
        </form>
  		@endif
  		</div>
  		<div class="col-md-12 pills">
        @if($transaksi != null)
					<div class="bd-example bd-example-tabs">
						<div class="d-flex">
						  <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">

						    <li class="nav-item">
						      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Pembayaran Booking</a>
						    </li>
						  </ul>
						</div>

					  <div class="tab-content" id="pills-tabContent">
					    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
					    	<div class="row">
					    		<div class="col-md-12">
					    			<p>Pembayaran Booking dapat dikirim ke rekening bank BCA <strong>088xxxxxx</strong> a.n <strong>Nabila</strong></p>
                    <p>Harga Jual: <strong>Rp{{$unit->hargaJual()}}</strong></p>
                    <p>Nominal Booking: <strong>Rp{{$unit->formatUang($unit->booking())}}</strong> (1% dari Harga Jual)</p>

                    @if($pembayaranBooking == null)
  					    			<form action="{{route('pembayaran_bookings.store')}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
  					    				{{csrf_field()}}
                        <input type="hidden" name="transaksi" value="{{$transaksi->id_transaksi}}">
                        <input type="hidden" name="nominal" value="{{$unit->booking()}}">
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
                        <strong>Info!</strong> Anda sudah mengirim bukti pembayaran booking.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{route('pembayaran_bookings.update',$pembayaranBooking)}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <input type="hidden" name="transaksi" value="{{$transaksi->id_transaksi}}">
                        <input type="hidden" name="nominal" value="{{$unit->booking()}}">
                        <h5>Ubah bukti transfer jika salah meng-upload gambar</h5>
                        <div class="form-group">
                          <label>Bukti Transfer</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="bukti" onchange="readURL(this)">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <img id="tampilangambar" src="{{asset($pembayaranBooking->gambar_bukti)}}" alt="Gambar bukti transfer" height="400">
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
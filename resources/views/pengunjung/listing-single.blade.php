@extends('layouts.pengunjung')

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
        <h1 class="mb-3 bread">Properties Details</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Properties Details<i class="ion-ios-arrow-forward"></i></span></p>
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
  						@if($unit->status == 'booking')
  						<button class="btn btn-secondary py-3 px-5" disabled>Terbooking</button>
  						@elseif($unit->status == 'terjual')
  						<button class="btn btn-secondary py-3 px-5" disabled>Terjual</button>
  						@else
  						<a href="{{route('pengunjung.booking',$unit)}}" class="btn btn-primary py-3 px-5">Booking</a>
  						@endif
              
              @if($customer != null && $customer->unitDimiliki($unit))
                @if($customer->transaksiUnit($unit)->status == 'aktif')
                <a href="{{route('pengunjung.pembatalan',$customer->transaksiUnit($unit))}}" class="btn btn-danger py-3 px-5">Batalkan</a>
                @else
                <a href="{{route('pengunjung.pembatalan',$customer->transaksiUnit($unit))}}" class="btn btn-danger py-3 px-5">Dibatalkan (Lihat Detail)</a>
                @endif
              @endif
  					</div>
  			</div>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-12 pills">
					<div class="bd-example bd-example-tabs">
						<div class="d-flex">
						  <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">

						    <li class="nav-item">
						      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Features</a>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
						    </li>
						  </ul>
						</div>

					  <div class="tab-content" id="pills-tabContent">
					    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
					    	<div class="row">
					    		<div class="col-md-4">
					    			<ul class="features">
					    				<li class="check"><span class="ion-ios-checkmark-circle"></span>Lantai: {{$unit->lantai}}</li>
					    				<li class="check"><span class="ion-ios-checkmark-circle"></span>Pemandangan: {{$unit->arahs->pemandangan}}</li>
					    				<li class="check"><span class="ion-ios-checkmark-circle"></span>Fasilitas: {{$unit->tipes->fasilitas}}</li>
					    			</ul>
					    		</div>
					    	</div>
					    </div>

					    <div class="tab-pane fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
					      <p>{{$unit->keterangan}}.</p>
					    </div>
					  </div>
					</div>
	      </div>
			</div>
  </div>
</section>
@endsection
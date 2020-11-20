@extends('layouts.pengunjung')

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
        <h1 class="mb-3 bread">About Us</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us <i class="ion-ios-arrow-forward"></i></span></p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-no-pb">
		<div class="container">
			<div class="row">
				<div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image: url('{{asset('web/images/about.jpg')}}');">
				</div>
				<div class="col-md-6 wrap-about pl-md-5 ftco-animate">
          <div class="heading-section">
            <h2 class="mb-4">Welcome To TAMANSARI</h2>

            <p>{{$welcome}}</p>
            <p><a href="{{url('/')}}" class="btn btn-primary">Find Properties</a></p>
          </div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-counter ftco-section ftco-no-pt ftco-no-pb img" id="section-counter">
	<div class="container">
		<div class="row">
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18 py-4 mb-4">
          <div class="text text-border d-flex align-items-center">
            <strong class="number" data-number="{{$totalLokasi}}">0</strong>
            <span>Lokasi <br>Apartemen</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18 py-4 mb-4">
          <div class="text text-border d-flex align-items-center">
            <strong class="number" data-number="{{$totalUnit}}">0</strong>
            <span>Unit <br>Apartemen</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18 py-4 mb-4">
          <div class="text text-border d-flex align-items-center">
            <strong class="number" data-number="{{$totalCustomer}}">0</strong>
            <span>Total <br>Pelanggan</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18 py-4 mb-4">
          <div class="text d-flex align-items-center">
            <strong class="number" data-number="{{$totalTransaksi}}">0</strong>
            <span>Total <br>Transaksi</span>
          </div>
        </div>
      </div>
    </div>
	</div>
</section>
<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h3 style="font-weight: 600; font-size: 20px;">Our Mission</h3>
				<p>{{$misi}}</p>
			</div>
			<div class="col-md-4">
				<h3 style="font-weight: 600; font-size: 20px;">Our Vission</h3>
				<p>{{$visi}}</p>
			</div>
			<div class="col-md-4">
				<h3 style="font-weight: 600; font-size: 20px;">Our Value</h3>
				<p>{{$nilai}}</p>
			</div>
		</div>
	</div>
</section>


<section class="ftco-section testimony-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center heading-section ftco-animate">
      	<span class="subheading">Testimonial</span>
        <h2 class="mb-3">Feedbacks</h2>
      </div>
    </div>
    <div class="row ftco-animate">
      <div class="col-md-12">
        <div class="carousel-testimony owl-carousel ftco-owl">
          @foreach($feedbacks as $feedback)
          <div class="item">
            <div class="testimony-wrap py-4">
              <div class="text">
                <p class="mb-4">{{$feedback->isi}}</p>
                <div class="d-flex align-items-center">
                  <div class="user-img" style="background-image: url('{{asset('web/images/person_1.jpg')}}')"></div>
                  <div class="pl-3">
                  <p class="name">{{ucfirst($feedback->customers->nama)}}</p>
                    <span class="position">Pelanggan</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
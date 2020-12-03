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
  				<!-- <div class="img rounded" style="background-image: url('{{asset('web/images/work-1.jpg')}}');"></div> -->
          <div id="carouselUnit" class="carousel slide mb-5" data-ride="carousel">
            <ol class="carousel-indicators">
              @foreach($unit->tipes->gambars as $gambar)
              <li data-target="#carouselUnit" data-slide-to="{{$loop->index}}" class="{{$loop->first ? 'active' : ''}}"></li>
              @endforeach
            </ol>
            <div class="carousel-inner" style="height: 480px;">
              @foreach($unit->tipes->gambars as $gambar)
              <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                <img src="{{asset($gambar->nama_gambar)}}" class="d-block w-100">
              </div>
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselUnit" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselUnit" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

  					<div class="text float-left">
	  					<h2>{{$unit->tipes->nama}} No. {{$unit->no_unit}}</h2>
	  					<span class="subheading">Tower {{$unit->towers->nama}}</span>
  						<p class="price d-inline"><span class="orig-price">{{$unit->hargaJual()}}</span></p>
              @if($customer != null && $customer->unitDimiliki($unit))
                <p>Verifikasi Pembelian: 
                  @if($customer->transaksiUnit($unit)->verifikasi == 'belum diterima')
                    <span class="badge badge-warning">{{$customer->transaksiUnit($unit)->verifikasi}}</span>
                  @elseif($customer->transaksiUnit($unit)->verifikasi == 'tidak diterima')
                    <span class="badge badge-danger">{{$customer->transaksiUnit($unit)->verifikasi}}</span>
                    <p>Transaksi Anda tidak diterima karena Unit ini sudah di-booking orang lain</p>
                  @else
                    <span class="badge badge-success">{{$customer->transaksiUnit($unit)->verifikasi}}</span>
                    @if($customer->transaksiUnit($unit)->pembayarandps == null)
                      <p>Transaksi Anda telah diverifikasi. Silahkan melakukan pembayaran DP</p>
                      <a href="{{route('pengunjung.dp',$unit)}}" class="btn btn-primary py-3 px-5">Bayar DP</a>
                    @else
                      <p>Transaksi Anda telah diverifikasi. Anda sudah membayar DP</p>
                      <a href="{{route('pengunjung.dp',$unit)}}" class="btn btn-primary py-3 px-5">Lihat Tanda Terima DP</a>
                    @endif
                  @endif
                </p>
              @endif
  					</div>
  					<div class="float-right">
              @if($unit->status == 'booking')
              <a href="{{route('pengunjung.booking',$unit)}}" class="btn btn-secondary py-3 px-5">Terbooking</a>
              @elseif($unit->status == 'terjual')
              <button class="btn btn-secondary py-3 px-5" disabled>Terjual</button>
              @else
              <a href="{{route('pengunjung.booking',$unit)}}" class="btn btn-primary py-3 px-5">Booking</a>
              @endif
              
              @if($customer != null && $customer->unitDimiliki($unit) && $customer->transaksiUnit($unit)->verifikasi == 'diterima')
                @if($customer->transaksiUnit($unit)->cicilans != null && $customer->transaksiUnit($unit)->jenis_bayar != 'lunas')
                <a href="{{route('pengunjung.cicilan',$customer->transaksiUnit($unit)->cicilans)}}" class="btn btn-info py-3 px-5">Cicilan</a>
                @endif
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
                      <li class="check"><span class="ion-ios-checkmark-circle"></span>Lokasi: {{$unit->towers->lokasis->nama_apartemen}}</li>
					    			</ul>
					    		</div>
					    	</div>
					    </div>

					    <div class="tab-pane fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
					      <ul class="features">
                  @if($unit->towers->lokasis->spesifikasi_bangunan != null)
                  <li class="check">
                    <span class="ion-ios-checkmark-circle"></span>
                    Lantai: {{$unit->towers->lokasis->spesifikasi_bangunan->lantai}}
                  </li>
                  <li class="check">
                    <span class="ion-ios-checkmark-circle"></span>
                    Dinding: {{$unit->towers->lokasis->spesifikasi_bangunan->dinding}}
                  </li>
                  <li class="check">
                    <span class="ion-ios-checkmark-circle"></span>
                    Plafon: {{$unit->towers->lokasis->spesifikasi_bangunan->platfon}}
                  </li>
                  <li class="check">
                    <span class="ion-ios-checkmark-circle"></span>
                    Instalasi Listrik: {{$unit->towers->lokasis->spesifikasi_bangunan->instalasi_listrik}}
                  </li>
                  <li class="check">
                    <span class="ion-ios-checkmark-circle"></span>
                    Sanitary: {{$unit->towers->lokasis->spesifikasi_bangunan->sanitary}}
                  </li>
                  <li class="check">
                    <span class="ion-ios-checkmark-circle"></span>
                    Pintu: {{$unit->towers->lokasis->spesifikasi_bangunan->pintu}}
                  </li>
                  <li class="check">
                    <span class="ion-ios-checkmark-circle"></span>
                    Jendela: {{$unit->towers->lokasis->spesifikasi_bangunan->jendela}}
                  </li>
                  <li class="check">
                    <span class="ion-ios-checkmark-circle"></span>
                    Air: {{$unit->towers->lokasis->spesifikasi_bangunan->air}}
                  </li>
                  @endif
                </ul>
					    </div>

					  </div>
					</div>
	      </div>
			</div>
  </div>
</section>
@endsection
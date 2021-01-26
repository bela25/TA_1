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
              @foreach($unit->tipes->gambars->where('lokasi',$unit->towers->lokasis->idlokasi) as $gambar)
              <li data-target="#carouselUnit" data-slide-to="{{$loop->index}}" class="{{$loop->first ? 'active' : ''}}"></li>
              @endforeach
            </ol>
            <div class="carousel-inner" style="height: 480px;">
              @foreach($unit->tipes->gambars->where('lokasi',$unit->towers->lokasis->idlokasi) as $gambar)
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

            @if($errors->any())
              <p class="alert alert-danger">{{$errors->first()}}</p>
            @endif
  					<div class="text float-left">
	  					<h2>{{$unit->tipes->nama}} No. {{$unit->no_unit}}</h2>
	  					<span class="subheading">Tower {{$unit->towers->nama}} - {{$unit->towers->lokasis->nama_apartemen}}</span>
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
                    @if($customer->transaksiUnit($unit)->pembayarandps == null  && $customer->transaksiUnit($unit)->pembayaranbookings != null && $customer->transaksiUnit($unit)->pembayaranbookings->verifikasi == 'diterima')
                      <p>Transaksi Anda telah diverifikasi. Silahkan melakukan pembayaran DP</p>
                      <a href="{{route('pengunjung.dp',$unit)}}" class="btn btn-primary py-3 px-5">Bayar DP</a>
                    @elseif($customer->transaksiUnit($unit)->pembayarandps != null  && $customer->transaksiUnit($unit)->pembayaranbookings != null && $customer->transaksiUnit($unit)->pembayaranbookings->verifikasi == 'diterima')
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
                @if($customer->transaksiUnit($unit)->cicilans != null)
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

    <!-- Recommended Units -->
    @if($units_recommend->count() > 0)
    <h5 class="font-weight-bold text-primary mt-5">Recommended Units</h5>
    <div class="row">
      @foreach($units_recommend as $recommend)
    	<div class="col-md-4">
    		<div class="property-wrap ftco-animate">
    			<div class="img d-flex align-items-center justify-content-center" style="background-image: url('{{$recommend->gambar()}}');">
    				<a href="{{route('pengunjung.listing.single',$recommend)}}" class="icon d-flex align-items-center justify-content-center btn-custom">
    					<span class="ion-ios-link"></span>
    				</a>
    			</div>
    			<div class="text">
    				<p class="price mb-3"><!-- <span class="old-price">800,000</span> --><span class="orig-price">{{$recommend->hargaJual()}}<small>/mo</small></span></p>
    				<h3 class="mb-0"><a href="{{route('pengunjung.listing.single',$recommend)}}">{{$recommend->tipes->nama}} No. {{$recommend->no_unit}}</a></h3>
    				<span class="location d-inline-block mb-3"><i class="ion-ios-pin mr-2"></i>
              Tower {{$recommend->towers->nama}}, 
              <a href="{{route('pengunjung.map', $recommend->towers->lokasis)}}">
                {{$recommend->towers->lokasis->nama_apartemen}}
              </a>
            </span>
    			</div>
    		</div>
    	</div>
      @endforeach
    </div>
    @endif

  	<div class="row">
  		<div class="col-md-12 pills">
          @if($customer != null && $customer->unitDimiliki($unit) && $customer->transaksiUnit($unit)->verifikasi == 'diterima')
            @if($unit->status == 'booking')
              <div class="alert alert-info mt-3" role="alert">
                Silahkan periksa pembayaran booking Anda dengan menekan tombol TERBOOKING berwarna abu-abu di pojok kanan.
              </div>
            @endif
          @endif
					<div class="bd-example bd-example-tabs">
						<div class="d-flex">
						  <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">

						    <li class="nav-item">
						      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Features</a>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
						    </li>
                <li class="nav-item">
						      <a class="nav-link" id="pills-progress-tab" data-toggle="pill" href="#pills-progress" role="tab" aria-controls="pills-progress" aria-expanded="true">Progress</a>
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

              <div class="tab-pane fade" id="pills-progress" role="tabpanel" aria-labelledby="pills-progress-tab">
					    	<div class="row">
					    		<div class="col-md-4">
					    			<ul class="features">
                      @foreach($unit->towers->lokasis->beritas->sortBy('tanggal') as $berita)
					    				<li class="check"><span class="ion-ios-checkmark-circle"></span>{{$berita->tanggalBerita()}}: <strong>{{$berita->progress}}</strong></li>
                      @endforeach
					    			</ul>
					    		</div>
					    	</div>
					    </div>

					  </div>

            @if(auth()->user()->customer != null)
            @if(session('pesan'))
            <div class="alert alert-success mt-3" role="alert">
              {{ session('pesan') }}
            </div>
            @endif
            <div class="row justify-content-center mt-3">
              <div class="col-md-6 align-items-stretch d-flex">
                <div class="card w-100">
                  <div class="card-header">
                    Chat (<strong>Unit {{ $unit->nama() }} - {{ $unit->towers->lokasis->nama_apartemen }}</strong>)
                  </div>
                  <div class="card-body overflow-auto" style="height: 240px">
                      @foreach($chattings as $chat)
                        @if($chat->pengirim == 'customer')
                        <div class="alert alert-warning text-right">
                          <small class="float-left">{{$chat->tanggal()}}</small>
                          <strong>{{$chat->customers->nama}}</strong>
                          <br>
                          {{$chat->pesan}}
                        </div>
                        @else
                        <div class="alert alert-secondary">
                          <strong>{{$chat->pegawais->nama}}</strong>
                          <small class="float-right">{{$chat->tanggal()}}</small>
                          <br>
                          {{$chat->pesan}}
                        </div>
                        @endif
                      @endforeach
                  </div>
                  <div class="card-footer">
                    <form action="{{route('pengunjung.chat')}}" method="post">
                      {{csrf_field()}}
                      <input type="hidden" name="unit" value="{{ $unit->id_unit }}">
                      <div class="input-group">
                        <input type="text" class="form-control" name="pesan" placeholder="Pesan" required>
                        <div class="input-group-append">
                          <button class="btn btn-outline-success" type="submit" id="button-addon2"><i class="fas fa-paper-plane"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              @if($customer->unitDimiliki($unit) && $customer->transaksiUnit($unit))
              <div class="col-md-6 align-items-stretch d-flex">
                <form action="{{route('pengunjung.feedback')}}" method="post" class="bg-light p-5 contact-form w-100">
                  <h5><strong>Feedback</strong></h5>
                  {{csrf_field()}}
                  <div class="form-group">
                    <input type="text" class="form-control" name="nama_unit" value="{{$unit->nama()}}" required readonly>
                    <input type="hidden" name="unit" value="{{$unit->id_unit}}">
                  </div>
                  <div class="form-group">
                    <!-- <label>Lokasi</label> -->
                    <!-- <select class="form-control" name="lokasi" required>
                      @foreach($lokasis as $lokasi)
                      <option value="{{$lokasi->idlokasi}}">{{$lokasi->nama_apartemen}}</option>
                      @endforeach
                    </select> -->
                    <input type="text" class="form-control" name="lokasi_name" value="{{$unit->towers->lokasis->nama_apartemen}}" required readonly>
                    <input type="hidden" name="lokasi" value="{{$unit->towers->lokasis->idlokasi}}">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="tanggal_feedback" value="{{date('Y-m-d')}}" required readonly>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="customer_name" value="{{auth()->user()->customer->nama}}" required readonly>
                    <input type="hidden" name="customer" value="{{auth()->user()->customer->idcustomers}}">
                  </div>
                  <div class="form-group">
                    <textarea name="isi" id="isi" cols="30" rows="7" class="form-control" placeholder="Berikan feedback" required></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Send Feedback" class="btn btn-primary py-3 px-5">
                  </div>
                </form>
              </div>
              @else
              <div class="col-md-6 align-items-start d-flex">
                <div class="alert alert-info" role="alert">
                  <p>Berikan feedback jika Anda sudah memesan unit ini agar kami dapat meningkatkan pelayanan kami.</p>
                </div>
              </div>
              @endif
            </div>
            @endif
            
					</div>
	      </div>
			</div>
  </div>
</section>
@endsection
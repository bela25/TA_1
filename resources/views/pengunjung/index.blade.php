@extends('layouts.pengunjung')

@push('styles')
<style>
.img-fit {
		width: 100%;
		height: 480px;
		max-height: 480px;
		object-fit: cover;
	}
</style>
@endpush

@section('content')
<div class="hero-wrap" style="background-image: url('{{asset('web/images/bg_2.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text justify-content-center align-items-center">
      <div class="col-lg-8 col-md-6 ftco-animate d-flex align-items-end">
      	<div class="text text-center w-100">
          <h1 class="mb-4">Find Properties <br>TamanSari</h1>
          <!-- <p><a href="#" class="btn btn-primary py-3 px-4">Search Properties</a></p> -->
        </div>
      </div>
    </div>
  </div>
  <div class="mouse">
		<a href="#" class="mouse-icon">
			<div class="mouse-wheel"><span class="ion-ios-arrow-round-down"></span></div>
		</a>
	</div>
</div>

@if(auth()->check() && auth()->user()->customer != null)
  @if($jatuhtempos->count() > 0)
  <section class="ftco-section ftco-no-pb">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="alert alert-danger" role="alert">
            Anda memiliki cicilan jatuh tempo. Klik link dibawah untuk melihat.
            <ul>
              @foreach($jatuhtempos as $jatuhtempo)
              <li>
                <a href="{{ route('pengunjung.cicilan', $jatuhtempo->cicilans) }}" class="alert-link">
                  <!-- -> buat manggil atribut atau method (bisa jadi inner join) -->
                  {{ $jatuhtempo->cicilans->transaksis->units->nama() }} - {{ $jatuhtempo->cicilans->transaksis->units->towers->lokasis->nama_apartemen }}
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
  @if($notifikasis->count() > 0)
  <section class="ftco-section ftco-no-pb">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="alert alert-info" role="alert">
            Anda memiliki Notifikasi.
            <ul>
              @foreach($notifikasis as $notifikasi)
              <li class="m-1">
                <form action="{{ route('pengunjung.bacanotif', $notifikasi) }}" method="post" class="form-inline">
                  {{csrf_field()}}
                  {{method_field('put')}}
                  {{ $notifikasi->pesan }}
                  <button type="submit" class="btn btn-secondary btn-sm ml-2">Tandai Dibaca</button>
                </form>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
@endif

<section class="ftco-section ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            @foreach($promosis as $promosi)
            <div class="carousel-item {{$loop->first ? 'active' : ''}}">
              <!-- <div class="alert alert-light"> -->
                <img src="{{asset($promosi->gambar)}}" class="img-fit">
                <div class="carousel-caption d-none d-md-block">
                  <div class="alert alert-light">
                    <h5 class="text-primary"><strong>{{$promosi->judul_promosi}}</strong></h5>
                    <p class="text-dark">{{$promosi->keterangan}}</p>

                  </div>
                </div>
              <!-- </div> -->
            </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-no-pb">
	<div class="container">
  	<div class="row">
			<div class="col-md-12">
				<div class="search-wrap-1 ftco-animate">
					<form action="{{route('pengunjung.index')}}" method="get" class="search-property-1">
        		<div class="row">
        			<div class="col-lg align-items-end">
                <div class="form-group">
                  <label for="#">Lokasi</label>
                  <div class="form-field">
                    <div class="select-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="lokasi" id="lokasi" class="form-control">
                        <option value="">Semua</option>
                        @foreach($lokasis as $item)
                          @if($item->idlokasi == $lokasi)
                          <option value="{{$item->idlokasi}}" selected>{{$item->nama_apartemen}}</option>
                          @else
                          <option value="{{$item->idlokasi}}">{{$item->nama_apartemen}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg align-items-end">
                <div class="form-group">
                  <label for="#">Harga Terendah</label>
                  <div class="form-field">
                    <input type="text" id="harga_min" name="harga_min" class="form-control" placeholder="Harga Terendah" step="100000000" value="{{$harga_min}}" onchange="NumericInput(this);">
                  </div>
                </div>
              </div>
        			<div class="col-lg align-items-end">
        				<div class="form-group">
        					<label for="#">Harga Tertinggi</label>
        					<div class="form-field">
                    <input type="text" id="harga_max" name="harga_max" class="form-control" placeholder="Harga Tertinggi" step="100000000" value="{{$harga_max}}" onchange="NumericInput(this);">
		              </div>
	              </div>
        			</div>
        			<div class="col-lg align-self-end">
        				<div class="form-group">
        					<div class="form-field">
		                <input type="submit" value="Search Property" class="form-control btn btn-primary">
		              </div>
	              </div>
        			</div>
        		</div>
        	</form>
        </div>
			</div>
  	</div>
    <div class="row">
			<div class="col-md-12">
				<div class="search-wrap-1 ftco-animate">
					<form action="{{route('pengunjung.index')}}" method="get" class="search-property-1">
        		<div class="row justify-content-center">
        			<div class="col-lg-3">
                <div class="form-group">
                  <label for="#">Urutkan</label>
                  <div class="form-field">
                    <div class="select-wrap">
                      <div class="icon" align="center"><span class="ion-ios-arrow-down" ></span></div>
                      <select name="sorting" id="sorting" class="form-control" onchange="this.form.submit()">
                        @foreach($sortings as $sorting)
                          @if($sorting == $sort)
                          <option value="{{$sorting}}" selected>{{$sorting}}</option>
                          @else
                          <option value="{{$sorting}}">{{$sorting}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
        		</div>
        	</form>
        </div>
			</div>
  	</div>
  </div>
</section>

<section class="ftco-section goto-here">
	<div class="container">
		<div class="row justify-content-center">
      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
      	<span class="subheading">What we offer</span>
        <h2 class="mb-2">Exclusive Offer For You</h2>
      </div>
    </div>
    <div class="row">
      @foreach($units as $unit)
    	<div class="col-md-4">
    		<div class="property-wrap ftco-animate">
    			<div class="img d-flex align-items-center justify-content-center" style="background-image: url('{{$unit->gambar()}}');">
    				<a href="{{route('pengunjung.listing.single',$unit)}}" class="icon d-flex align-items-center justify-content-center btn-custom">
    					<span class="ion-ios-link"></span>
    				</a>
    				<!-- <div class="list-agent d-flex align-items-center">
    					<a href="#" class="agent-info d-flex align-items-center">
    						<div class="img-2 rounded-circle" style="background-image: url('{{asset('web/images/person_1.jpg')}}');"></div>
    						<h3 class="mb-0 ml-2">Ben Ford</h3>
    					</a>
    					<div class="tooltip-wrap d-flex">
    						<a href="#" class="icon-2 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Bookmark">
    							<span class="ion-ios-heart"><i class="sr-only">Bookmark</i></span>
    						</a>
    						<a href="#" class="icon-2 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Compare">
    							<span class="ion-ios-eye"><i class="sr-only">Compare</i></span>
    						</a>
    					</div>
    				</div> -->
    			</div>
    			<div class="text">
    				<p class="price mb-3"><!-- <span class="old-price">800,000</span> --><span class="orig-price">{{$unit->hargaJual()}}<small>/mo</small></span></p>
    				<h3 class="mb-0"><a href="{{route('pengunjung.listing.single',$unit)}}">{{$unit->tipes->nama}} No. {{$unit->no_unit}}</a></h3>
    				<span class="location d-inline-block mb-3"><i class="ion-ios-pin mr-2"></i>
              Tower {{$unit->towers->nama}}, 
              <a href="{{route('pengunjung.map', $unit->towers->lokasis)}}">
                {{$unit->towers->lokasis->nama_apartemen}}
              </a>
            </span>
    				<!-- <ul class="property_list">
    					<li><span class="flaticon-bed"></span>3</li>
    					<li><span class="flaticon-bathtub"></span>2</li>
    					<li><span class="flaticon-floor-plan"></span>1,878 sqft</li>
    				</ul> -->
    			</div>
    		</div>
    	</div>
      @endforeach
    </div>
	</div>
</section>

<section class="ftco-counter ftco-section img" id="section-counter">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text text-border d-flex align-items-center">
            <strong class="number" data-number="{{$totalLokasi}}">0</strong>
            <span>Lokasi <br>Apartemen</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text text-border d-flex align-items-center">
            <strong class="number" data-number="{{$totalUnit}}">0</strong>
            <span>Unit <br>Apartemen</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text text-border d-flex align-items-center">
            <strong class="number" data-number="{{$totalCustomer}}">0</strong>
            <span>Total <br>Pelanggan</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text d-flex align-items-center">
            <strong class="number" data-number="{{$totalTransaksi}}">0</strong>
            <span>Total <br>Transaksi</span>
          </div>
        </div>
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

@push('scripts')
<script>
$(document).ready(function () {
  var numericKeys = '0123456789';

  // add the thousands separator first time
  var hargaMin = $('#harga_min');
  var hargaMax = $('#harga_max');
  NumericInputFormat(hargaMin);
  NumericInputFormat(hargaMax);
  NumericInput(document.getElementById('harga_min'));
  NumericInput(document.getElementById('harga_max'));
  // console.log(hargaMin.val(), hargaMax.val(), min, max)
});

function NumericInputFormat(input) {
  var tmp = input.val().replace(/[,.RrPp]/g, '');
  var val = Number(tmp).toLocaleString();

  if (tmp == '') {
    input.val('');
  } else {
    input.val('Rp'+val);
  }
  // return val;
}
</script>
@endpush
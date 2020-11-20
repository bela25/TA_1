@extends('layouts.pengunjung')

@section('content')
<div class="hero-wrap" style="background-image: url('{{asset('web/images/bg_2.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text justify-content-center align-items-center">
      <div class="col-lg-8 col-md-6 ftco-animate d-flex align-items-end">
      	<div class="text text-center w-100">
          <h1 class="mb-4">Find Properties <br>That Make You Money</h1>
          <p><a href="#" class="btn btn-primary py-3 px-4">Search Properties</a></p>
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


<section class="ftco-section ftco-no-pb">
	<div class="container">
  	<div class="row">
			<div class="col-md-12">
				<div class="search-wrap-1 ftco-animate">
					<form action="#" class="search-property-1">
        		<div class="row">
        			<div class="col-lg align-items-end">
        				<div class="form-group">
        					<label for="#">Property Type</label>
        					<div class="form-field">
          					<div class="select-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="" id="" class="form-control">
                      	<option value="">Type</option>
                        <option value="">Commercial</option>
                        <option value="">- Office</option>
                        <option value="">Residential</option>
                        <option value="">Villa</option>
                        <option value="">Condominium</option>
                        <option value="">Apartment</option>
                      </select>
                    </div>
		              </div>
	              </div>
        			</div>
        			<div class="col-lg align-items-end">
                <div class="form-group">
                  <label for="#">Price Limit</label>
                  <div class="form-field">
                    <div class="select-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="" id="" class="form-control">
                        <option value="">$5,000</option>
                        <option value="">$10,000</option>
                        <option value="">$50,000</option>
                        <option value="">$100,000</option>
                        <option value="">$200,000</option>
                        <option value="">$300,000</option>
                        <option value="">$400,000</option>
                        <option value="">$500,000</option>
                        <option value="">$600,000</option>
                        <option value="">$700,000</option>
                        <option value="">$800,000</option>
                        <option value="">$900,000</option>
                        <option value="">$1,000,000</option>
                        <option value="">$2,000,000</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
        			<div class="col-lg align-items-end">
        				<div class="form-group">
        					<label for="#">Price Limit</label>
        					<div class="form-field">
          					<div class="select-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="" id="" class="form-control">
                        <option value="">$5,000</option>
                        <option value="">$10,000</option>
                        <option value="">$50,000</option>
                        <option value="">$100,000</option>
                        <option value="">$200,000</option>
                        <option value="">$300,000</option>
                        <option value="">$400,000</option>
                        <option value="">$500,000</option>
                        <option value="">$600,000</option>
                        <option value="">$700,000</option>
                        <option value="">$800,000</option>
                        <option value="">$900,000</option>
                        <option value="">$1,000,000</option>
                        <option value="">$2,000,000</option>
                      </select>
                    </div>
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
    			<div class="img d-flex align-items-center justify-content-center" style="background-image: url('{{asset('web/images/work-2.jpg')}}');">
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
    				<p class="price mb-3"><!-- <span class="old-price">800,000</span> --><span class="orig-price">Rp{{$unit->hargaJual()}}<small>/mo</small></span></p>
    				<h3 class="mb-0"><a href="{{route('pengunjung.listing.single',$unit)}}">{{$unit->tipes->nama}} No. {{$unit->no_unit}}</a></h3>
    				<span class="location d-inline-block mb-3"><i class="ion-ios-pin mr-2"></i>Tower {{$unit->towers->nama}}, {{$unit->towers->lokasis->nama_apartemen}}</span>
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
            <strong class="number" data-number="305">0</strong>
            <span>Area <br>Population</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text text-border d-flex align-items-center">
            <strong class="number" data-number="1090">0</strong>
            <span>Total <br>Properties</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text text-border d-flex align-items-center">
            <strong class="number" data-number="209">0</strong>
            <span>Average <br>House</span>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
        <div class="block-18">
          <div class="text d-flex align-items-center">
            <strong class="number" data-number="67">0</strong>
            <span>Total <br>Branches</span>
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
        <h2 class="mb-3">Happy Clients</h2>
      </div>
    </div>
    <div class="row ftco-animate">
      <div class="col-md-12">
        <div class="carousel-testimony owl-carousel ftco-owl">
          @for($i = 0; $i < 3; $i++)
          <div class="item">
            <div class="testimony-wrap py-4">
              <div class="text">
                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                <div class="d-flex align-items-center">
                	<div class="user-img" style="background-image: url('{{asset('web/images/person_1.jpg')}}')"></div>
                	<div class="pl-3">
                    <p class="name">Roger Scott</p>
                    <span class="position">Marketing Manager</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endfor
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
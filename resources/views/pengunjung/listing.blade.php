@extends('layouts.pengunjung')

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
        <h1 class="mb-3 bread">Properties</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Properties <i class="ion-ios-arrow-forward"></i></span></p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section goto-here">
	<div class="container">
    <div class="row">
      @foreach($units as $unit)
    	<div class="col-md-4">
    		<div class="property-wrap ftco-animate">
    			<div class="img d-flex align-items-center justify-content-center" style="background-image: url('{{asset('web/images/work-1.jpg')}}');">
    				<a href="{{route('pengunjung.listing.single',$unit)}}" class="icon d-flex align-items-center justify-content-center btn-custom">
    					<span class="ion-ios-link"></span>
    				</a>
    				<!-- <div class="list-agent d-flex align-items-center">
    					<a href="#" class="agent-info d-flex align-items-center">
    						<div class="img-2 rounded-circle" style="background-image: url(images/person_1.jpg);"></div>
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
    				<p class="price mb-3"><span class="orig-price">Rp{{$unit->hargaJual()}}</span></p>
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
    <div class="row mt-5">
      <div class="col text-center">
        <div class="block-27">
          <ul>
            <li><a href="#">&lt;</a></li>
            <li class="active"><span>1</span></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&gt;</a></li>
          </ul>
        </div>
      </div>
    </div>
	</div>
</section>
@endsection
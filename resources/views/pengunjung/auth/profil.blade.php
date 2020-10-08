@extends('layouts.pengunjung')

@push('styles')
<style type="text/css">
  .hero-wrap.hero-wrap-2{
    height: 120px !important;
  }
  p.price span{
    font-size: 24px !important;
  }
</style>
@endpush

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
</section>

<section class="ftco-section ftco-no-pb">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
        <span class="subheading">Listing</span>
        <h2 class="mb-2">Daftar Unit yang telah dibooking atau dibeli</h2>
      </div>
    </div>
    <!-- Outer Row -->
    <div class="row">
      @foreach($transaksis as $transaksi)
      <div class="col-md-4">
        <div class="property-wrap ftco-animate">
          <div class="img d-flex align-items-center justify-content-center" style="background-image: url('{{asset('web/images/work-1.jpg')}}');">
            <a href="{{route('pengunjung.listing.single',$transaksi->units)}}" class="icon d-flex align-items-center justify-content-center btn-custom">
              <span class="ion-ios-link"></span>
            </a>
            @if(isset($transaksi->pegawai))
            <div class="list-agent d-flex align-items-center">
              <a href="#" class="agent-info d-flex align-items-center">
                <div class="img-2 rounded-circle" style="background-image: url('{{asset('web/images/person_1.jpg')}}');"></div>
                <h3 class="mb-0 ml-2">{{$transaksi->pegawais->nama}}</h3>
              </a>
              <!-- <div class="tooltip-wrap d-flex">
                <a href="#" class="icon-2 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Bookmark">
                  <span class="ion-ios-heart"><i class="sr-only">Bookmark</i></span>
                </a>
                <a href="#" class="icon-2 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Compare">
                  <span class="ion-ios-eye"><i class="sr-only">Compare</i></span>
                </a>
              </div> -->
            </div>
            @endif
          </div>
          <div class="text d-flex justify-content-between">
            <div>
              <p class="price mb-3"><span class="orig-price">Rp{{$transaksi->units->hargaJual()}}</span></p>
              <h3 class="mb-0"><a href="{{route('pengunjung.listing.single',$transaksi->units)}}">{{$transaksi->units->nama()}}</a></h3>
              <span class="location d-inline-block mb-3"><i class="ion-ios-pin mr-2"></i>Tower {{$transaksi->units->towers->nama}}</span>
              <!-- <ul class="property_list">
                <li><span class="flaticon-bed"></span>3</li>
                <li><span class="flaticon-bathtub"></span>2</li>
                <li><span class="flaticon-floor-plan"></span>1,878 sqft</li>
              </ul> -->
            </div>
            <div class="text-right">
              <h5><span class="badge badge-secondary">{{$transaksi->units->status}}</span></h5>
              @if($transaksi->status == 'tidak aktif')
              <h5><span class="badge badge-danger">Dibatalkan</span></h5>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <!-- container -->
</section>
@endsection
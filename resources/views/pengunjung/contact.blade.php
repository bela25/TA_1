@extends('layouts.pengunjung')

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
        <h1 class="mb-3 bread">Contact Us</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section contact-section">
  <div class="container">
    <div class="row d-flex mb-5 contact-info justify-content-center">
    	<div class="col-md-8">
    		<div class="row mb-5">
	          <div class="col-md-4 text-center py-4">
	          	<div class="icon mb-3 d-flex align-items-center justify-content-center">
	          		<span class="icon-map-o"></span>
	          	</div>
	            <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
	          </div>
	          <div class="col-md-4 text-center py-4">
	          	<div class="icon mb-3 d-flex align-items-center justify-content-center">
	          		<span class="icon-mobile-phone"></span>
	          	</div>
	            <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
	          </div>
	          <div class="col-md-4 text-center py-4">
	          	<div class="icon mb-3 d-flex align-items-center justify-content-center">
	          		<span class="icon-envelope-o"></span>
	          	</div>
	            <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
	          </div>
	        </div>
      </div>
    </div>
    <!-- <div class="row block-9 justify-content-center mb-5">
      <div class="col-md-6 align-items-stretch d-flex">
        @if(auth()->check() && auth()->user()->customer != null)
        <form action="{{route('pengunjung.feedback')}}" method="post" class="bg-light p-5 contact-form">
          <h5><strong>Feedback</strong></h5>
          {{csrf_field()}}
          <div class="form-group">
            <input type="text" class="form-control" name="tanggal_feedback" value="{{date('Y-m-d')}}" required readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="customer_name" value="{{auth()->user()->customer->nama}}" required readonly>
            <input type="hidden" name="customer" value="{{auth()->user()->customer->idcustomers}}">
          </div>
          <div class="form-group">
            <select class="form-control" name="lokasi" required>
              @foreach($lokasis as $lokasi)
              <option value="{{$lokasi->idlokasi}}">{{$lokasi->nama_apartemen}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <textarea name="isi" id="isi" cols="30" rows="7" class="form-control" placeholder="Berikan feedback" required></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Send Feedback" class="btn btn-primary py-3 px-5">
          </div>
        </form>
        @else
        <div class="alert alert-light w-100" role="alert">
          <p>Untuk memberikan <strong>Feedback</strong> dan <strong>Chatting</strong>, Harap login terlebih dahulu.</p>
          <p><a href="{{route('pengunjung.login')}}" class="btn btn-primary py-3 px-5">Login</a></p>
        </div>
        @endif
      </div>
      <div class="col-md-6 align-items-stretch d-flex">
        @if(auth()->check())
        <div class="card w-100">
          <div class="card-header">
            Chat
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
              <div class="input-group">
                <input type="text" class="form-control" name="pesan" placeholder="Pesan" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-success" type="submit" id="button-addon2"><i class="fas fa-paper-plane"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        @endif
      </div>
    </div> -->
  </div>
</section>
@endsection
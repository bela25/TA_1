@extends('layouts.pengunjung')

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
        <h1 class="mb-3 bread">Properties Cancel</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Properties Cancel<i class="ion-ios-arrow-forward"></i></span></p>
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
  		@if($transaksi->status == 'aktif')
  			<form action="{{route('pembatalans.store')}}" method="post" class="bg-light p-5 contact-form mt-3">
          <h5 class="text-danger">Apakah Anda yakin ingin membatalkan transaksi?</h5>
          <p>Tolong berikan alasan Anda</p>
  				{{csrf_field()}}
          <input type="hidden" name="transaksi" value="{{$transaksi->id_transaksi}}">
          @if(isset($transaksi->pegawais))
          <div class="form-group">
            <label>Admin</label>
            <input type="text" class="form-control" name="admin_nama" value="{{$transaksi->pegawais->nama}}" readonly="true">
            <input type="hidden" class="form-control" name="admin" value="{{$transaksi->pegawais->nip}}">
          </div>
          @endif
          <div class="form-group">
            <label>Alasan</label>
            <textarea class="form-control" name="alasan" rows="3"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Batalkan" class="btn btn-danger py-3 px-5">
          </div>
        </form>
  		@endif
  		</div>
  		<div class="col-md-12 pills">
        @if($transaksi->status == 'tidak aktif')
					<div class="bd-example bd-example-tabs">
						<div class="d-flex">
						  <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">

						    <li class="nav-item">
						      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Pembatalan</a>
						    </li>
						  </ul>
						</div>

					  <div class="tab-content" id="pills-tabContent">
					    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
					    	<div class="row">
					    		<div class="col-md-12">
                    <h5 class="text-primary">Alasan Pembatan</h5>
                    <p>{{ $pembatalan->alasan }}</p>
                    <h5 class="text-primary">Detail Pembatalan</h5>
					    			<p>Pengembalian dana akan dikirim ke rekening bank BCA <strong>088xxxxxx</strong> a.n <strong>{{$transaksi->customers->nama}}</strong></p>
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Harga Beli
                        <strong>Rp{{$transaksi->units->hargaJual()}}</strong>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Nominal Pengembalian (dipotong 20% biaya pembatalan)
                        <strong>Rp{{$pembatalan->showNominal()}}</strong>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tanggal Pengembalian
                        <strong>{{$pembatalan->tanggalPengembalian()}}</strong>
                      </li>
                    </ul>

                    @if($pembatalan->gambar_bukti != null)
                      <h5 class="mt-3 mb-3"><span class="badge badge-success">Pengembalian sudah di transfer</span></h5>
  					    			<img id="tampilangambar" src="{{asset($pembatalan->gambar_bukti)}}" alt="Gambar bukti transfer">
                    @else
                      <h5 class="mt-3"><span class="badge badge-secondary">Pengembalian belum di transfer</span></h5>
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
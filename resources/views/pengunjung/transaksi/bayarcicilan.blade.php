@extends('layouts.pengunjung')

@section('content')
<section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('{{asset('web/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="overlay-2"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
        <h1 class="mb-3 bread">Properties Cicilan</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Properties Cicilan<i class="ion-ios-arrow-forward"></i></span></p>
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
	  					<p class="price d-inline"><span class="orig-price">{{$unit->hargaJual()}}</span></p>
              @if($transaksi != null)
                <p>Verifikasi Pembelian: 
                  @if($transaksi->verifikasi == 'belum diterima')
                  <span class="badge badge-warning">{{$transaksi->verifikasi}}</span>
                  @else
                  <span class="badge badge-success">{{$transaksi->verifikasi}}</span>
                  @endif
                </p>
              @endif
  					</div>
            <div class="float-right">
              <a href="{{route('pengunjung.listing.single',$unit)}}" class="btn btn-secondary py-3 px-5">Kembali</a>
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
  		</div>
  		<div class="col-md-12 pills">
					<div class="bd-example bd-example-tabs">
						<div class="d-flex">
						  <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">

						    <li class="nav-item">
						      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Pembayaran Cicilan</a>
						    </li>
						  </ul>
						</div>

					  <div class="tab-content" id="pills-tabContent">
					    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
					    	<div class="row">
					    		<div class="col-md-12">
					    			<p>Pembayaran Cicilan dapat dikirim ke rekening bank BCA <strong>088xxxxxx</strong> a.n <strong>Nabila</strong></p>
                    <p>Nominal Cicilan: <strong>Rp{{$pembayaran_cicilan->formatUang($pembayaran_cicilan->nominal)}}</strong></p>

                    @if($pembayaran_cicilan->gambar_bukticicilan == null)
                      <form action="{{route('pengunjung.simpancicilan',$pembayaran_cicilan)}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <h5>Upload bukti transfer jika sudah melakukan pembayaran</h5>
                        <div class="form-group">
                          <label>Bukti Transfer</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="bukti" onchange="readURL(this)">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <img id="tampilangambar" src="{{asset($pembayaran_cicilan->gambar_bukticicilan)}}" alt="Gambar bukti transfer" height="400">
                        </div>
                        <div class="form-group">
                          <input type="submit" value="Upload" class="btn btn-primary py-3 px-5">
                        </div>
                      </form>
                    @else
                      <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> Anda sudah mengirim bukti pembayaran cicilan.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @if($pembayaran_cicilan->verifikasi == 'diterima')
                      <p>
                        Status pembayaran cicilan anda : <span class="badge badge-success">{{ $pembayaran_cicilan->verifikasi }}</span>
                      </p>
                      <p>
                        Tanda Terima Cicilan
                        <button class="btn btn-success" onclick="printing()">Print</button>
                      </p>
                      <div class="card" id="print-area">
                        <div class="card-body p-5">
                          <h1 class="text-primary text-center"><strong>Tamansari {{$unit->towers->lokasis->nama_apartemen}}</strong></h1>
                          <h5 class="text-center"><strong>Tanda Terima Cicilan</strong></h5>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Sudah terima dari
                              <span><strong>{{ucfirst($transaksi->customers->nama)}}</strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Banyaknya uang
                              <span><strong>{{$pembayaran_cicilan->formatUang($pembayaran_cicilan->nominal)}}</strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Angsuran Ke
                              <span><strong>{{$pembayaran_cicilan->cicilan_ke}}</strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Unit
                              <span><strong>{{$unit->no_unit}} Lantai {{$unit->lantai}}</strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Tipe
                              <span><strong>{{$unit->tipes->nama}}</strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Diterima pada
                              <span><strong>{{$pembayaran_cicilan->tanggalBayar()}}</strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Admin
                              <span><strong>{{ucfirst($transaksi->pegawais->nama ?? '')}}</strong></span>
                            </li>
                          </ul>
                        </div>
                      </div>
                      @elseif($pembayaran_cicilan->verifikasi == 'tidak diterima')
                      <p>
                        Status pembayaran cicilan anda : <span class="badge badge-danger">{{ $pembayaran_cicilan->verifikasi }}</span>
                      </p>
                      <form action="{{route('pengunjung.simpancicilan',$pembayaran_cicilan)}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <h5>Upload bukti transfer jika sudah melakukan pembayaran</h5>
                        <div class="form-group">
                          <label>Bukti Transfer</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="bukti" onchange="readURL(this)">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <img id="tampilangambar" src="{{asset($pembayaran_cicilan->gambar_bukticicilan)}}" alt="Gambar bukti transfer" height="400">
                        </div>
                        <div class="form-group">
                          <input type="submit" value="Upload" class="btn btn-primary py-3 px-5">
                        </div>
                      </form>
                      @else
                      <p>
                        Status pembayaran cicilan anda : <span class="badge badge-warning">{{ $pembayaran_cicilan->verifikasi }}</span>
                      </p>
                      @endif
                    @endif
					    		</div>
					    	</div>
					    </div>
              <!-- tab-pande -->
					  </div>
            <!-- tab-content -->
					</div>
          <!-- bd -->
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
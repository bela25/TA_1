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
  						<p class="price d-inline"><span class="orig-price">Rp{{$unit->hargaJual()}}</span></p>
                <p>Verifikasi: 
                  @if($transaksi->verifikasi == 'belum diterima')
                  <span class="badge badge-warning">{{$transaksi->verifikasi}}</span>
                  @else
                  <span class="badge badge-success">{{$transaksi->verifikasi}}</span>
                  @endif
                </p>
  					</div>
  					<div class="float-right">
              <a href="{{route('pengunjung.listing.single',$unit)}}" class="btn btn-secondary py-3 px-5">Kembali</a>
  					</div>
  			</div>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-12 pills">
        @if(session('pesan'))
          <div class="alert alert-success" role="alert">
            {{session('pesan')}}
          </div>
        @endif
					<div class="bd-example bd-example-tabs">
						<div class="d-flex">
						  <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">

						    <li class="nav-item">
						      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Cicilan</a>
						    </li>
						  </ul>
						</div>

					  <div class="tab-content" id="pills-tabContent">
					    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                <p>Tangal Mulai: <strong>{{$cicilan->tanggal_mulai}}</strong></p>
                <p>Tangal Akhir: <strong>{{$cicilan->tanggal_akhir}}</strong></p>
                <p>Bunga: <strong>{{$cicilan->bunga}}%</strong></p>
					    	<div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Cicilan Ke</th>
                        <th>Harga Cicilan</th>
                        <th>Tenggat Waktu</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Bukti</th>
                        <th>Interaksi</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($pembayaran_cicilans as $pembayaran_cicilan)
                      <tr class="{{ $pembayaran_cicilan->jatuhTempo() ? 'table-danger' : '' }}">
                        <td>{{$pembayaran_cicilan->cicilan_ke}}</td>
                        <td>Rp{{$pembayaran_cicilan->formatUang($pembayaran_cicilan->nominal)}}</td>
                        <td>{{$pembayaran_cicilan->tenggat_waktu}}</td>
                        <td>
                          @if($pembayaran_cicilan->tanggal_bayar == null)
                          <span class="badge badge-secondary">Belum bayar</span>
                          @else
                          <span class="badge badge-success">{{$pembayaran_cicilan->tanggal_bayar}}</span>
                          @endif
                        </td>
                        <td>
                          @if($pembayaran_cicilan->gambar_bukticicilan == null)
                          <span class="badge badge-secondary">Belum bayar</span>
                          @else
                          <a href="{{asset($pembayaran_cicilan->gambar_bukticicilan)}}" target="_blank">{{$pembayaran_cicilan->gambar_bukticicilan}}</a>
                          @endif
                        </td>
                        <td>
                          @if($pembayaran_cicilan->gambar_bukticicilan == null)
                          <a href="{{route('pengunjung.bayarcicilan',$pembayaran_cicilan)}}" class="btn btn-primary">Bayar</a>
                          @else
                          <!-- <a href="{{route('pengunjung.bayarcicilan',$pembayaran_cicilan)}}" class="btn btn-primary">Ganti Bukti</a> -->
                          <a href="{{route('pengunjung.bayarcicilan',$pembayaran_cicilan)}}" class="btn btn-primary">Lihat Bukti</a>
                          @endif
                          <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$pembayaran_cicilan->id_pembayarancicilan}}">Hapus</button> -->
                          <div class="modal fade" id="delete{{$pembayaran_cicilan->id_pembayarancicilan}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Peringatan</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Data ini akan dihapus secara permanen, Anda yakin untuk menghapus?&hellip;</p>
                                   <form role="form" action="{{route('pembayaran_cicilans.destroy',$pembayaran_cicilan)}}" method="post" id="hapus{{$pembayaran_cicilan->id_pembayarancicilan}}">
                                    {{csrf_field()}}
                                    {{method_field('delete')}}
                                    
                                    <!-- /.card-body -->
                                  </form>
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                  <button type="submit" class="btn btn-primary" form="hapus{{$pembayaran_cicilan->id_pembayarancicilan}}">Yes</button>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  <p class="font-italic">*Ket: Baris berwarna merah = cicilan jatuh tempo</p>
                </div>
                <!-- table-responsive -->
					    </div>

					  </div>
					</div>
	      </div>
			</div>
  </div>
</section>
@endsection
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

@if($jatuhtempos->count() > 0)
<div class="container mt-5">
  <div class="row">
    <div class="col-12">
      <div class="alert alert-danger" role="alert">
        Anda memiliki cicilan jatuh tempo. Klik link dibawah untuk melihat.
        <ul>
          @foreach($jatuhtempos as $jatuhtempo)
          <li>
            <a href="{{ route('pengunjung.cicilan', $jatuhtempo->cicilans) }}" class="alert-link">
              {{ $jatuhtempo->cicilans->transaksis->units->nama() }} - {{ $jatuhtempo->cicilans->transaksis->units->towers->lokasis->nama_apartemen }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endif

<section class="ftco-section ftco-no-pb">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
        <span class="subheading">Dokumen</span>
        <h2 class="mb-2">Daftar dokumen untuk verifikasi</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Verifikasi</h6>
            <a href="{{ route('verifikasis.create')}}" class="btn btn-primary ">
              Tambah Data
            </a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>KTP</th>
                    <th>KK</th>
                    <th>NPWP</th>
                    <th>Tanggal Diterima</th>
                    <th>Interaksi</th>
                  </tr>
                </thead>

                <tbody>
                  @forelse($customer->verifikasis as $verifikasi)
                  <tr>
                    <td>{{$verifikasi->tanggal}}</td>
                    <td>{{$verifikasi->status}}</td>
                    <td><a href="{{asset($verifikasi->ktp)}}" target="_blank">{{$verifikasi->ktp}}</a></td>
                    <td><a href="{{asset($verifikasi->kk)}}" target="_blank">{{$verifikasi->kk}}</a></td>
                    <td><a href="{{asset($verifikasi->npwp)}}" target="_blank">{{$verifikasi->npwp}}</a></td>
                    <td>
                      @if($verifikasi->tgl_diterima != null)
                        <span class="badge badge-success">{{ $verifikasi->tgl_diterima }}</span>
                      @else
                        <span class="badge badge-secondary">Belum diterima</span>
                      @endif
                    </td>
                    <td>
                      @if($verifikasi->tgl_diterima == null)
                      <!-- <a href="{{route('verifikasis.edit',$verifikasi)}}" class="btn btn-primary">Ubah</a> -->
                      <a href="{{ route('verifikasis.edit', $customer->verifikasi)}}" class="btn btn-primary">Ubah Data</a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$verifikasi->idverifikasi}}">Hapus</button>
                      <div class="modal fade" id="delete{{$verifikasi->idverifikasi}}">
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
                               <form role="form" action="{{route('verifikasis.destroy',$verifikasi)}}" method="post" id="hapus{{$verifikasi->idverifikasi}}">
                                {{csrf_field()}}
                                {{method_field('delete')}}
                                <!-- /.card-body -->
                              </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-danger" form="hapus{{$verifikasi->idverifikasi}}">Hapus</button>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    Belum ada data.
                  </tr>
                  @endforelse

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
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
              <p class="price mb-3"><span class="orig-price">{{$transaksi->units->hargaJual()}}</span></p>
              <h3 class="mb-0"><a href="{{route('pengunjung.listing.single',$transaksi->units)}}">{{$transaksi->units->nama()}}</a></h3>
              <span class="location d-inline-block mb-3"><i class="ion-ios-pin mr-2"></i>
                Tower {{$transaksi->units->towers->nama}}, 
                <a href="{{route('pengunjung.map', $transaksi->units->towers->lokasis)}}">
                  {{$transaksi->units->towers->lokasis->nama_apartemen}}
                </a>
              </span>
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
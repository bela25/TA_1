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
        <span class="subheading">Dokumen</span>
        <h2 class="mb-2">Daftar dokumen untuk verifikasi</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Verifikasi</h6>
          </div>
          <div class="card-body">
            <form action="{{route('verifikasis.store')}}" method="post" enctype="multipart/form-data" class="bg-light p-5 contact-form" >
              {{csrf_field()}}
              <label>Tanggal</label>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" name="tanggal" value="{{ date('d M Y') }}" readonly>
              </div>
              <div class="form-group">
                <label>Status</label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="belummenikah" name="status" value="belum menikah" checked required>
                  <label for="belummenikah" class="custom-control-label">Belum Menikah</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="menikah" name="status" value="menikah" required>
                  <label for="menikah" class="custom-control-label">Menikah</label>
                </div>
              </div>
              <div class="form-group">
                <label>KTP</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="ktp" onchange="readURL(this,'ktp')" required>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>
                <img id="tampilanktp" src="#" alt="tampilan ktp"/>
              </div>
              <div class="form-group">
                <label>KK</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="kk" onchange="readURL(this,'kk')" required>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>
                <img id="tampilankk" src="#" alt="tampilan kk"/>
              </div>
              <div class="form-group">
                <label>NPWP</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="npwp" onchange="readURL(this,'npwp')" required>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>
                <img id="tampilannpwp" src="#" alt="tampilan npwp"/>
              </div>
              <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary py-3 px-5">
                <a href="{{ route('pengunjung.profil') }}" class="btn btn-secondary py-3 px-5">Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- container -->
</section>
@endsection
@push('scripts')
<script type="text/javascript">
  function readURL(input,type) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            var div = $('#tampilanktp');
            if(type == 'kk'){
              div = $('#tampilankk');
            }
            else if(type == 'npwp'){
              div = $('#tampilannpwp');
            }
              div
                  .attr('src', e.target.result)
                  .width('auto')
                  .height(200);
            
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>
@endpush
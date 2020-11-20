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
        <span class="subheading">Ubah Password</span>
        <h2 class="mb-2">Data Profil</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
          </div>
          <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <form action="{{route('pengunjung.simpanpassword', $customer)}}" method="post" class="bg-light p-5 contact-form" >
              {{csrf_field()}}
              {{method_field('PUT')}}
              <div class="form-group">
                <label for="password_lama">Password Lama</label>
                <input type="password" class="form-control" id="password_lama" placeholder="Isi Password Lama" name="password_lama" required>
              </div>
              <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" class="form-control" id="password" placeholder="Isi Password Baru" name="password" required>
              </div>
              <div class="form-group">
                <label for="password_confirmation">Ulangi Password Baru</label>
                <input type="password" class="form-control" id="password_confirmation" placeholder="Ulangi Password Baru" name="password_confirmation" required>
              </div>
              <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary py-3 px-5">
                <a href="{{ route('pengunjung.profil') }}" class="btn btn-secondary py-3 px-5">Kembali</a>
              </div>
            </form>
          </div>
        </div>
        <!-- card -->
      </div>
    </div>
  </div>
  <!-- container -->
</section>
@endsection
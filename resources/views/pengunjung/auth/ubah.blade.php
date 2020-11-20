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
        <span class="subheading">Ubah Profil</span>
        <h2 class="mb-2">Data Profil</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Profil</h6>
          </div>
          <div class="card-body">
            <form action="{{route('pengunjung.simpanprofil', $customer)}}" method="post" class="bg-light p-5 contact-form" >
              {{csrf_field()}}
              {{method_field('PUT')}}
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama" value="{{$customer->nama}}" required>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" placeholder="Isi Alamat" name="alamat"
                value="{{$customer->alamat}}" required>
              </div>
              <div class="form-group">
                <label for="noktp">No KTP</label>
                <input type="text" class="form-control" id="noktp" placeholder="Isi No KTP" name="noktp"
                value="{{$customer->no_ktp}}" required>
              </div>
              <div class="form-group">
                <label for="alamat">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempatlahir" placeholder="Isi Tempat Lahir" name="tempatlahir" value="{{$customer->tempat_lahir}}" required>
              </div>
              <div class="form-group">
                <label for="tgllahir">Tanggal Lahir</label>
                <input type="text" class="form-control" id="tgllahir" placeholder="Isi Tanggal Lahir" name="tgllahir" value="{{$customer->tgl_lahir}}" required>
              </div>
              <div class="form-group">
                <label for="notelp">No Telp</label>
                <input type="text" class="form-control" id="notelp" placeholder="Isi No Telp" name="notelp"
                value="{{$customer->no_telp}}" required>
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="Laki-laki" name="gender" value="Laki-laki" checked required>
                  <label for="Laki-laki" class="custom-control-label">Laki-laki</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="Perempuan" name="gender" value="Perempuan" required {{$customer->gender == 'Perempuan' ? 'checked' : ''}}>
                  <label for="Perempuan" class="custom-control-label">Perempuan</label>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Isi Email" name="email"
                value="{{$customer->user->email}}" required>
              </div>
              <!-- <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Isi Username" name="username" value="{{$customer->username}}" required>
              </div> -->
              <!-- <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Isi Password" required>
              </div> -->
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
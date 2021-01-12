@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Home</h1>
</div>

<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-12 col-md-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Welcome Back!</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ auth()->user()->name }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-12 col-md-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Notifikasi!</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Ada <span class="badge badge-danger">{{ $notifikasis->count() }}</span> notifikasi</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-bell fa-2x text-gray-300"></i>
          </div>
        </div>
        <hr>
        <ul class="list-group mt-3">
          @foreach($notifikasis as $notifikasi)
          <li class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{ $notifikasi->tanggal() }}</h5>
              <small>{{ $notifikasi->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-1">{{ $notifikasi->pesan }}</p>
            <form action="{{ route('pengunjung.bacanotif', $notifikasi) }}" method="post" class="form-inline">
              {{csrf_field()}}
              {{method_field('put')}}
              <button type="submit" class="btn btn-primary btn-sm">Tandai Dibaca</button>
            </form>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

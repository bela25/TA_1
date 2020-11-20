@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-4">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Customer</h6>
      </div>
      <div class="card-body">
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Nama
            <strong>{{$customer->nama}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Alamat
            <strong>{{$customer->alamat}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            No. KTP
            <strong>{{$customer->tgl_lahir}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            No. Telp
            <strong>{{$customer->no_telp}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Jenis Kelamin
            <strong>{{$customer->gender}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Email
            <strong>{{$customer->email}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Username
            <strong>{{$customer->username}}</strong>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-8">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Verifikasi</h6>
        @if($customer->verifikasi->tgl_diterima == null)
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accept">Terima</button>
        <div class="modal fade" id="accept">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Terima Data Verifikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Data verifikasi diterima hari ini pada tanggal {{ date('d M Y') }}&hellip;</p>
                <form role="form" action="{{route('verifikasis.verifikasi',$customer->verifikasi)}}" method="post" id="terima">
                  {{csrf_field()}}
                  {{method_field('put')}}
                  <input type="hidden" name="aksi" value="diterima">
                  <!-- /.card-body -->
                </form>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success" form="terima">Terima</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        @else
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#accept">Batal Terima</button>
        <div class="modal fade" id="accept">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Batal Terima Data Verifikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Data verifikasi batal diterima hari ini pada tanggal {{ date('d M Y') }}&hellip;</p>
                <form role="form" action="{{route('verifikasis.verifikasi',$customer->verifikasi)}}" method="post" id="terima">
                  {{csrf_field()}}
                  {{method_field('put')}}
                  <input type="hidden" name="aksi" value="batal">
                  <!-- /.card-body -->
                </form>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger" form="terima">Batal Terima</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        @endif
      </div>
      <div class="card-body">
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Tanggal
            <strong>{{$customer->verifikasi->tanggal}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Status
            <strong>{{$customer->verifikasi->status}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Tanggal Diterima
            <strong>
              @if($customer->verifikasi->tgl_diterima != null)
                <span class="badge badge-success">{{$customer->verifikasi->tgl_diterima}}</span>
              @else
                <span class="badge badge-secondary">Belum diterima</span>
              @endif
            </strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            KTP
            <!-- <strong><a href="{{asset($customer->verifikasi->ktp)}}" target="_blank">{{$customer->verifikasi->ktp}}</a></strong> -->
            <img src="{{asset($customer->verifikasi->ktp)}}" style="height: 200px">
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            KK
            <!-- <strong><a href="{{asset($customer->verifikasi->kk)}}" target="_blank">{{$customer->verifikasi->kk}}</a></strong> -->
            <img src="{{asset($customer->verifikasi->kk)}}" style="height: 200px">
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            NPWP
            <!-- <strong><a href="{{asset($customer->verifikasi->npwp)}}" target="_blank">{{$customer->verifikasi->npwp}}</a></strong> -->
            <img src="{{asset($customer->verifikasi->npwp)}}" style="height: 200px">
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->
@endsection
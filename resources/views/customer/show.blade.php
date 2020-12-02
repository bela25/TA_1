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
            <strong>{{$customer->user->email}}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Username
            <strong>{{$customer->user->username ?? ''}}</strong>
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
            @foreach($customer->verifikasis as $verifikasi)
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
                <!-- <a href="{{route('customers.edit',$customer)}}" class="btn btn-primary">Ubah</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$customer->idcustomers}}">Hapus</button>
                <div class="modal fade" id="delete{{$customer->idcustomers}}">
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
                         <form role="form" action="{{route('customers.destroy',$customer)}}" method="post" id="hapus{{$customer->idcustomers}}">
                          {{csrf_field()}}
                          {{method_field('delete')}}                      
                        </form>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary" form="hapus{{$customer->idcustomers}}">Yes</button>
                      </div>
                    </div>
                    
                  </div>
                  
                </div> -->
                @if($verifikasi->tgl_diterima == null)
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
                        <form role="form" action="{{route('verifikasis.verifikasi',$verifikasi)}}" method="post" id="terima">
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
                <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel">Batal Terima</button>
                <div class="modal fade" id="cancel">
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
                        <form role="form" action="{{route('verifikasis.verifikasi',$verifikasi)}}" method="post" id="terima">
                          {{csrf_field()}}
                          {{method_field('put')}}
                          <input type="hidden" name="aksi" value="batal">
                        </form>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger" form="terima">Batal Terima</button>
                      </div>
                    </div>
                  </div>
                </div> -->
                @endif
              </td>
            </tr>

            @endforeach

            </tbody>
          </table>
        </div>
        
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->
@endsection
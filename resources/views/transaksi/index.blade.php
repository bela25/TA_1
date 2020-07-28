@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Transaksi</h6>
    <a href="{{ route('transaksis.create')}}" class="btn btn-primary ">
     <i class="fas fa-plus-square"> </i>PLUS
   </a>
 </div>
 <div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
         <th>Customer</th>
         <th>Unit</th>
         <th>Harga Jual</th>
         <th>Jenis Bayar</th>
         <th>Tanggal Pembayaran</th>
         <th>Verifikasi</th>
         <th>Status</th>
         <th>Tanggal Pelunasan</th>
         <th>Admin</th>
         <th>Interaksi</th>
       </tr>
     </thead>

     <tbody>
      @foreach($transaksis as $transaksi)
       <tr>
         <td><a href="{{route('transaksis.index')}}">{{$transaksi->customers->nama}}</a></td>
         <td><a href="{{route('transaksis.index')}}">{{$transaksi->units->no_unit}}</td>
         <td><a href="{{route('transaksis.index')}}">{{$transaksi->harga_juals->hargajual_cash}}</td>
         <td>{{$transaksi->jenis_bayar}}</td>
         <td>{{$transaksi->tanggal}}</td>
         <td>{{$transaksi->veriikasi}}</td>
         <td>{{$transaksi->status}}</td>
         <td>{{$transaksi->tgl_pelunasan}}</td>
         <td><a href="{{route('transaksis.edit',$transaksi)}}" class="btn btn-primary btn-sm">Ubah</a>
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#delete{{$transaksi->id_transaksi}}">
           Hapus</button>
           <div class="modal fade" id="delete{{$transaksi->id_transaksi}}">
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
                  <form role="form" action="{{route('transaksis.destroy',$transaksi)}}" method="post" id="hapus{{$transaksi->id_transaksi}}">
                    {{csrf_field()}}
                    {{method_field('delete')}}

                    <!-- /.card-body -->
                  </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                  <button type="submit" class="btn btn-primary" form="hapus{{$transaksi->id_transaksi}}">Yes</button>
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
</div>
</div>
</div>

<!-- /.container-fluid -->


@endsection
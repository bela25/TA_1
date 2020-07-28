@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Spesifikasi Bangunan</h6>
    <a href="{{ route('spesifikasi_bangunans.create')}}" class="btn btn-primary ">
     <i class="fas fa-plus-square"> </i> PLUS
   </a>
 </div>
 <div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
         <th>Lantai</th>
         <th>Dinding</th>
         <th>Platfon</th>
         <th>Instalasi Listrik</th>
         <th>Sanitary</th>
         <th>Pintu</th>
         <th>Jendela</th>
         <th>Air</th>
         <th>Admin</th>
         <th>Tanggal Pembuataan</th>
         <th>Updated_at</th>
         <th>Interaksi</th>
       </tr>
     </thead>
    <tbody>
     @foreach($spesifikasi_bangunans as $spesifikasi_bangunan)
     <tr>
       <td>{{$spesifikasi_bangunan->lantai}}</td>
       <td>{{$spesifikasi_bangunan->dinding}}</td>
       <td>{{$spesifikasi_bangunan->platfon}}</td>
       <td>{{$spesifikasi_bangunan->instalasi_listrik}}</td>
       <td>{{$spesifikasi_bangunan->sanitary}}</td>
       <td>{{$spesifikasi_bangunan->pintu}}</td>
       <td>{{$spesifikasi_bangunan->jendela}}</td>
       <td>{{$spesifikasi_bangunan->air}}</td>
       <td><a href="{{route('pegawais.index')}}">{{$spesifikasi_bangunan->pegawais->nama}}</a></td>
       <td>{{$spesifikasi_bangunan->created_at}}</td>
       <td>{{$spesifikasi_bangunan->updated_at}}</td>
      <td><a href="{{route('spesifikasi_bangunans.edit',$spesifikasi_bangunan)}}" class="btn btn-primary btn-sm">Ubah</a>
         <button type="button" class="btn btn-default" data-toggle="modal" data-target="#delete{{$spesifikasi_bangunan->idspesikasi}}">
                  Hapus</button>
      <div class="modal fade" id="delete{{$spesifikasi_bangunan->idspesikasi}}">
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
               <form role="form" action="{{route('spesifikasi_bangunans.destroy',$spesifikasi_bangunan)}}" method="post" id="hapus{{$spesifikasi_bangunan->idspesikasi}}">
                {{csrf_field()}}
                {{method_field('delete')}}
                
                <!-- /.card-body -->
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-primary" form="hapus{{$spesifikasi_bangunan->idspesikasi}}">Yes</button>
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
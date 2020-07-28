  @extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    <a href="{{ route('customers.create')}}" class="btn btn-primary ">
     <i class="fas fa-plus-square"> </i>PLUS
   </a>
 </div>
 <div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
         <th>Nama</th>
         <th>Alamat</th>
         <th>No KTP</th>
         <th>Tanggal Lahir</th>
         <th>No telp</th>
         <th>Gender</th>
         <th>Email</th>
         <th>Username</th>
         <th>Password</th>
         <th>Created_at</th>
         <th>Updated_at</th>
         <th>Interaksi</th>
       </tr>
     </thead>
    <tbody>
     @foreach($customers as $customer)
     <tr>
       <td>{{$customer->nama}}</td>
       <td>{{$customer->alamat}}</td>
       <td>{{$customer->no_ktp}}</td>
       <td>{{$customer->tgl_lahir}}</td>
       <td>{{$customer->no_telp}}</td>
       <td>{{$customer->gender}}</td>
       <td>{{$customer->email}}</td>
       <td>{{$customer->username}}</td>
       <td>{{$customer->password}}</td>
       <td>{{$customer->created_at}}</td>
       <td>{{$customer->updated_at}}</td>
      <td><a href="{{route('customers.edit',$customer)}}" class="btn btn-primary btn-sm">Ubah</a>
         <button type="button" class="btn btn-default" data-toggle="modal" data-target="#delete{{$customer->idcustomers}}">
                  Hapus</button>
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
                
                <!-- /.card-body -->
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-primary" form="hapus{{$customer->idcustomers}}">Yes</button>
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
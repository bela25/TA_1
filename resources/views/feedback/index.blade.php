@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Feedback</h6>
    <a href="{{ route('feedbacks.create')}}" class="btn btn-primary ">
      <i class="fas fa-plus-square"></i> TAMBAH
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Tanggal Feedback</th>
            <th>Lokasi</th>
            <th>Pegawai</th>
            <th>Customer</th>
            <th>Isi</th>
            <th>Reply</th>
            <th>Interaksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($feedbacks as $feedback)
          <tr>
            <td>{{$feedback->tanggal_feedback}}</td>
            <td>{{$feedback->lokasis->nama_apartemen}}</td>
            <td>{{$feedback->pegawais->nama}}</td>
            <td>{{$feedback->customers->nama}}</td>
            <td>{{$feedback->isi}}</td>
            <td>{{$feedback->reply}}</td>
            <td>
              <a href="{{route('feedbacks.edit',$feedback)}}" class="btn btn-primary">Ubah</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$feedback->idfeedback}}">Hapus</button>
              <div class="modal fade" id="delete{{$feedback->idfeedback}}">
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
                       <form role="form" action="{{route('feedbacks.destroy',$feedback)}}" method="post" id="hapus{{$feedback->idfeedback}}">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary" form="hapus{{$feedback->idfeedback}}">Yes</button>
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
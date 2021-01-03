@extends('layouts.master')


@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Chatting</h6>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-3 align-items-stretch d-flex">
        <div class="list-group w-100 overflow-auto" style="height: 360px">
          @foreach($customers as $item)
            @if($item->idcustomers == $customer->idcustomers)
            <a href="{{route('chattings.index', ['customer'=>$item])}}" class="list-group-item list-group-item-action active">{{$item->nama}}</a>
            @else
            <a href="{{route('chattings.index', ['customer'=>$item])}}" class="list-group-item list-group-item-action">{{$item->nama}}</a>
            @endif
          @endforeach
        </div>
      </div>
      <div class="col-9 align-items-stretch d-flex">
        <div class="card w-100">
          <div class="card-header">
            Chat
          </div>
          <div class="card-body overflow-auto" style="height: 240px">
            @foreach($chattings as $chat)
              @if($chat->pengirim == 'pegawai')
              <div class="alert alert-warning text-right">
                <small class="float-left">{{$chat->tanggal()}}</small>
                <strong>{{$chat->pegawais->nama}}</strong>
                <!-- <form class="float-left">
                  <button type="submit" class="btn btn-sm p-0"><i class="fas fa-times-circle"></i></button>
                </form> -->
                <br>
                {{$chat->pesan}}
              </div>
              @else
              <div class="alert alert-secondary">
                <strong>{{$chat->customers->nama}}</strong>
                <small class="float-right">{{$chat->tanggal()}}</small>
                <br>
                {{$chat->pesan}}
              </div>
              @endif
            @endforeach
          </div>
          <div class="card-footer">
            <form action="{{route('chattings.store')}}" method="post">
              {{csrf_field()}}
              <div class="input-group">
                <input type="text" class="form-control" name="pesan" placeholder="Pesan" required>
                <input type="hidden" name="customer" value="{{$customer->idcustomers}}">
                <div class="input-group-append">
                  <button class="btn btn-outline-success" type="submit" id="button-addon2"><i class="fas fa-paper-plane"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- card -->
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->


@endsection
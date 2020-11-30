@extends('layouts.back')
@section('title','Pet Channels')
@section('content')
    <div class="container-fluid">

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between">

                    <h5 class="m-0 font-weight-bold text-primary">Pet Update Channels</h5>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">Channel Update</th>
                            <th class="text-center">Date Joined</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="text-center">Channel Update</th>
                            <th class="text-center">Date Joined</th>
                            <th class="text-center">Status</th>
                        </tfoot>
                        <tbody>
                        @foreach($channels as $channel)
                            <tr>
                                <td>{{$channel->name}}</td>

                                @if($channel->users()->where('user_id',Auth::id())->exists())
                                    @foreach($channel->users as $user)
                                        <td class="text-center">{{date('M d, Y', strtotime($user->pivot->created_at))}}</td>
                                        <td class="text-center">
                                            <form action="/subscribe-to-channel" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$channel->id}}" name="channel_id">
                                                <button type="submit" class="btn btn-success btn-sm btn-icon-split">
                                                <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Joined</span>
                                                </button>
                                            </form>
                                        </td>
                                    @endforeach
                                @else
                                <td class="text-center">-</td>
                                    <td class="text-center">
                                        <form action="/subscribe-to-channel" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$channel->id}}" name="channel_id">
                                            <button type="submit" class="btn btn-danger btn-sm btn-icon-split">
                                                <span class="icon text-white-50"><i class="fas fa-thumbs-up"></i></span><span class="text">Join</span>
                                            </button>
                                        </form>
                                  </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

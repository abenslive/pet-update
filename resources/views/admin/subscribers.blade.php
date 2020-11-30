@extends('layouts.back')
@section('title','Subscribers')
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Subscribers</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">Name </th>
                            <th class="text-center">Channel(s)</th>
                            <th class="text-center">Date Joined</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Channel(s)</th>
                            <th class="text-center">Date Joined</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($subscribers as $subscriber)
                        <tr>
                            <td>{{$subscriber->name}} <small>({{$subscriber->username}})</small></td>
                            <td class="text-center">{{$subscriber->petChannels->count()}} </td>
                            <td class="text-center">{{date('M d, Y', strtotime($subscriber->created_at))}} </td>
                            <td class="text-center">
                                <a title="Make user Active or In-Active" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                <a title="View user details" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                <a title="Edit User Info" class="btn btn-info btn-sm"><i class="fas fa-pen"></i></a>
                                <a title="Delete User" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

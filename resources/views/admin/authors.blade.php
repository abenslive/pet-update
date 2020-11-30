@extends('layouts.back')
@section('title','Authors')
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

                <h5 class="m-0 font-weight-bold text-primary">Authors</h5>

                <a href="#" class="float-right btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#addAuthorModal">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-user"></i>
                                        </span>
                    <span class="text">Add Author</span>
                </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" style="min-width:600px" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">Name </th>
                            <th class="text-center">Post(s)</th>
                            <th class="text-center">Date Joined</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Post(s)</th>
                            <th class="text-center">Date Joined</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($authors as $author)
                        <tr>
                            <td>{{$author->name}} <small>({{$author->username}})</small></td>
                            <td class="text-center">{{$author->posts->count()}} </td>
                            <td class="text-center">{{date('M d, Y', strtotime($author->created_at))}} </td>
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
    <div class="modal fade" id="addAuthorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <form action="{{route('new-author')}}" method="POST">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Author</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col m-2">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="name">Username</label>
                                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}" required>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Email</label>
                                            <input type="email" name="email"  class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Name</label>
                                            <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label" for="gridCheck">
                                            Authors' Default Password: <strong>12345678</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Author</button>
            </div>
        </div>
        </form>
    </div>
    </div>
@endsection

@extends('adminlte::page')

@section('title', 'Quality Checker')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Quality Checker') }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('staffs.create') }}" class="btn bg-gradient-primary float-right">Add Quality Checker</a>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                @foreach (['danger', 'warning', 'success', 'info'] as $message)
                    @if(Session::has($message))
                        <div class="alert alert-{{ $message }}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session($message) }}
                        </div>
                    @endif
                @endforeach
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quality Checker</h3>
                      <form class="float-right d-flex search-form">
                          <button class="btn btn-sm btn-info" type="submit"  >
                            <span class=" d-flex">
                               <i class="fa fa-filter" aria-hidden="true"></i>Filter</span>
                          </button>
                          
                          <input class="form-control" type="text" name="search" placeholder="search">
                      </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-sm action-hide">
                            <thead>
                            <tr>
                                <th style="width: 50px">S.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Joined On</th>
                                <th>Left On</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = ($qualitycheckers->currentpage()-1)* $qualitycheckers->perpage() + 1; @endphp
                                @forelse ($qualitycheckers as $index => $qualitychecker)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $qualitychecker->name }}</td>
                                        <td>{{ $qualitychecker->email }}</td>
                                        <td>{{ $qualitychecker->phone }}</td>
                                        <td>{{$qualitychecker->joined_on}}</td>
                                        <td>{{$qualitychecker->left_on}}</td>
                                        <td>
                                            <a href="{{ route('qualitycheckers.show',$qualitychecker->id) }}" class="btn btn-sm btn-warning">View</a>
                                            @if(!$qualitychecker->deleted_at)
                                            <a href="{{ route('staffs.edit',$qualitychecker->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form method="POST" action="{{ route('qualitycheckers.destroy', $qualitychecker->id) }}"
                                                accept-charset="UTF-8"
                                                style="display: inline-block;"
                                                onsubmit="return confirm('Are you sure do you want to delete?');">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                 @empty
                                    <tr>
                                        <th colspan="7" class="text-center">No Data Found...</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {!! $qualitycheckers->links() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>
    </section>
@stop

@extends('adminlte::page')

@section('title', 'Designers')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Designers') }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('staffs.create') }}" class="btn bg-gradient-primary float-right">Add Designers</a>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
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
                        <h3 class="card-title">Designers</h3>
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
                                <th style="width: 100px">S.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Joined On</th>
                                <th>Left On</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = ($designers->currentpage()-1)* $designers->perpage() + 1; @endphp
                                @forelse ($designers as $designer)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $designer->name }}</td>
                                        <td>{{ $designer->email }}</td>
                                        <td>{{ $designer->phone }}</td>
                                        <td>{{$designer->joined_on}}</td>
                                        <td>{{$designer->left_on}}</td>
                                        <td>
                                            <a href="{{ route('designers.show',$designer->id) }}" class="btn btn-sm btn-warning">View</a>
                                            @if(!$designer->deleted_at)
                                            <a href="{{ route('staffs.edit',$designer->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form method="POST" action="{{ route('designers.destroy', $designer->id) }}"
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
                            {!! $designers->links() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>
    </section>
@stop

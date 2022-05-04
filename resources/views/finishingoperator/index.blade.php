@extends('adminlte::page')

@section('title', 'Finishing Operator')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Finishing Operator') }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('staffs.create') }}" class="btn bg-gradient-primary float-right">Add finishingoperator</a>
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
                        <h3 class="card-title">Finishing Operator</h3>
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
                                @php $i = ($finishingoperators->currentpage()-1)* $finishingoperators->perpage() + 1; @endphp
                                @forelse ($finishingoperators as $finishingoperator)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $finishingoperator->name }}</td>
                                        <td>{{ $finishingoperator->email }}</td>
                                        <td>{{ $finishingoperator->phone }}</td>
                                        <td>{{$finishingoperator->joined_on}}</td>
                                        <td>{{$finishingoperator->left_on}}</td>
                                        <td>
                                            <a href="{{ route('finishingoperators.show',$finishingoperator->id) }}" class="btn btn-sm btn-warning">View</a>
                                            @if(!$finishingoperator->deleted_at)
                                            <a href="{{ route('staffs.edit',$finishingoperator->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form method="POST" action="{{ route('finishingoperators.destroy', $finishingoperator->id) }}"
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
                            {!! $finishingoperators->links() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>
    </section>
@stop

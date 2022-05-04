@extends('adminlte::page')

@section('title', 'Sales Reps')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Sales Reps') }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('staffs.create') }}" class="btn bg-gradient-primary float-right">Add Sales Rep</a>
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
                        <h3 class="card-title">Sales Reps</h3>
                      <form class="float-right">
                          <input class="" type="text" name="search" >
                          <button class="btn btn-sm btn-info" type="submit">
                            search
                          </button>
                      </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
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
                                @php $i = ($salesreps->currentpage()-1)* $salesreps->perpage() + 1; @endphp
                                @forelse ($salesreps as $salesrep)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $salesrep->name }}</td>
                                        <td>{{ $salesrep->email }}</td>
                                        <td>{{ $salesrep->phone }}</td>
                                        <td>{{$salesrep->joined_on}}</td>
                                        <td>{{$salesrep->left_on}}</td>
                                        <td>
                                            <a href="{{ route('salesreps.show',$salesrep->id) }}" class="btn btn-sm btn-warning">View</a>
                                            @if(!$salesrep->deleted_at)
                                            <a href="{{ route('staffs.edit',$salesrep->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form method="POST" action="{{ route('salesreps.destroy', $salesrep->id) }}"
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
                            {!! $salesreps->links() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>
    </section>
@stop

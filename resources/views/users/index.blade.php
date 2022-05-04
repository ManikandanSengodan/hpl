@extends('adminlte::page')

@section('title', 'Admin User')

@section('content_header')
    <div class="row mb-0">
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="offset-md-0 col-md-10">
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
                        <h3 class="card-title">Admin</h3>
                        <div class="col-sm-6 float-right">
                            <a href="{{ route('users.create') }}" class="btn bg-gradient-primary float-right">Add Admin</a>
                        </div>
{{--                      <form class="float-right d-flex search-form" name="search_form">--}}
{{--                          <button class="btn btn-sm btn-info" type="submit"  >--}}
{{--                            <span class=" d-flex">--}}
{{--                               <i class="fa fa-filter" aria-hidden="true"></i>Filter</span>--}}
{{--                          </button>--}}
{{--                          --}}
{{--                          <input class="form-control" type="text" id="search" name="search" placeholder="search">--}}
{{--                      </form>--}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
{{--                        <table class="table table-bordered table-sm action-hide" id="dataTables-example">--}}
                            <table class="table table-hover table-sm table-striped table-bordered action-hide" id="list-datatable">
                            <thead>
                            <tr>
                                <th style="width: 50px">S.No</th>
                                <th>Name</th>
                                <th>Mobile No</th>
                                <th>Email</th>
                                <th>Joined On</th>
                                <th>Left On</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = ($users->currentpage()-1)* $users->perpage() + 1; @endphp
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{date("d-m-Y", strtotime($user->created_at) )  }}</td>
                                        <td>@if($user->deleted_at){{ date("d-m-Y", strtotime($user->deleted_at) ) }}@endif</td>
                                        <td>
                                            <a href="{{ route('users.show',$user->id) }}" class="btn btn-sm btn-info">View</a>
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                                accept-charset="UTF-8"
                                                style="display: inline-block;"
                                                onsubmit="return confirm('Are you sure do you want to delete?');">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                                            </form>
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
                </div>
                <!-- /.card -->
            </div>
            </div>
            </div>
        </div>
    </section>

    <script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script>
        jQuery('#list-datatable').dataTable({
            "oLanguage": {
                "sEmptyTable": "No contents to display"
            },
            order: [],
            aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [-1, 'no-sort'],
                },
                // {orderable: false, targets: [0, 1]},
            ]
        });
    </script>
@stop

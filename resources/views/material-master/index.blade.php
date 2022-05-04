@extends('adminlte::page')

@section('title', 'Raw Material')

@section('content_header')
    <div class="row mb-1">
        <div class="col-12">
            <h1 class="float-left ml-2 font-weight-bold">
              {{ __('Meterial Master') }}
            </h1>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
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
                        <h3 class="card-title">Material Master </h3>
                        <div class="float-right">
                            <a href="{{ route('material-master.create') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Add Material') }}</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-sm table-striped table-bordered action-hide" id="list-datatable">
                            <thead>
                            <tr>
                                <th style="width: 250px">S.No</th>
                                <th>Name</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = ($inks->currentpage()-1)* $inks->perpage() + 1; @endphp
                                @forelse ($inks as $ink)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ink->name }}</td>
                                        <td>
                                            <a href="{{ route('material-master.show',$ink->id) }}" class="btn btn-sm btn-warning">View</a>
                                            @if(!$ink->deleted_at)
                                            <a href="{{ route('material-master.edit',$ink->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form method="POST" action="{{ route('material-master.destroy', $ink->id) }}"
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
                                        <th colspan="8" class="text-center">No Data Found...</th>
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

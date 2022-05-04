@extends('adminlte::page')

@section('title', 'Cut Fold Machine Master')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Cut Fold Machine Master') }}</h1>
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
                        <h3 class="card-title">Cut Fold Machine</h3>
                        <div class="float-right">
                            <a href="{{ route('cut-fold-machine.create') }}" class="btn bg-gradient-primary float-right">Add Cut Fold Machine</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-sm table-striped table-bordered action-hide" id="list-datatable">
                            <thead>
                            <tr>
                                <th style="width: 100px">S.No</th>
                                <th>Name</th>
                                <th>Fold</th>
                                <th>Operator Designated</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = ($cutFoldMachines->currentpage()-1)* $cutFoldMachines->perpage() + 1; @endphp
                                @forelse ($cutFoldMachines as $cutFoldMachine)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ucwords($cutFoldMachine->name) }}</td>
                                        <td>{{ ucwords($cutFoldMachine->fold) }}</td>
                                        <td>{{ ucwords($cutFoldMachine->operator_designated) }}</td>
                                        <td>
                                            <a href="{{ route('cut-fold-machine.show',$cutFoldMachine->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form method="POST" action="{{ route('cut-fold-machine.destroy', $cutFoldMachine->id) }}"
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
                                        <th colspan="3" class="text-center">No Data Found...</th>
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

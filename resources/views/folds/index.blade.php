@extends('adminlte::page')

@section('title', 'Folds')

@section('content_header')
    <div class="row mb-0">
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
                        <h3 class="card-title">Folds</h3>
                        <div class="float-right">
                            <a href="{{ route('folds.create') }}" class="btn bg-gradient-primary float-right">Add Folds</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-sm table-striped table-bordered action-hide" id="list-datatable">
                            <thead>
                            <tr>
                                <th style="width: 100px">S.No</th>
                                <th>Type of Fold</th>
                                <th>Image</th>
                                <th>Minimum mm</th>
                                <th>Maximum mm</th>
                                <!--<th>Notes</th>-->
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = ($folds->currentpage()-1)* $folds->perpage() + 1; @endphp
                                @forelse ($folds as $fold)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $fold->type_of_fold }}</td>
                                        <td><img src="{{ $fold->image }}" alt="image" width="50" height="50"></td>
                                        <td>{{ $fold->minimum_mm }}</td>
                                        <td>{{ $fold->maximum_mm }}</td>
                                        <!--<td>{{ $fold->notes ?? '-'}}</td>-->
                                        
                                        <td>
                                            <a href="{{ route('folds.show',$fold->id) }}" class="btn btn-sm btn-warning">View</a>
                                            @if(!$fold->deleted_at)
                                            <a href="{{ route('folds.edit',$fold->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form method="POST" action="{{ route('folds.destroy', $fold->id) }}"
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
                                        <th colspan="6" class="text-center">No Data Found...</th>
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

@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <div class="container-fluid-center">
        <div class="row mb-1">
            <div class="col-md-12">
                <h1 class="float-left font-weight-bold">Categories</h1>
            </div>
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
                        <h3 class="card-title">Category</h3>
                        <div class="float-right">
                            <a href="{{ route('category.create') }}" class="btn bg-gradient-primary float-right">Add Category</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-sm table-striped table-bordered action-hide" id="list-datatable">
                            <thead>
                            <tr>
                                <th style="width: 250px">S.No</th>
                                <th>Category</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = ($categories->currentpage()-1)* $categories->perpage() + 1; @endphp
                                @forelse ($categories as $index => $category)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ucwords($category->category_name) }}</td>
                                        <td>
                                            <a href="{{ route('category.show',$category->id) }}" class="btn btn-sm btn-info">View</a>
                                            <form method="POST" action="{{ route('category.destroy', $category->id) }}"
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

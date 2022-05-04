@extends('adminlte::page')

@section('title', 'Invoice')

@section('content_header')
    <div class="row mb-0">
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('shared.errors')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Invoice</h3>
                            <div class="col-sm-6 float-right">
                                <a href="{{route('invoice.create')}}" class="btn bg-gradient-primary float-right">{{ __('Add Invoice') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-hover table-sm table-striped table-bordered action-hide" id="list-datatable">
                                <thead>
                                <tr>
                                    <th style="width: 50px">S.No</th>
                                    <th>SALES INVOICE NUMBER</th>
                                    <th>PARTY NAME</th>
                                    <th>DUE AMOUNT</th>
                                    <th>Balance</th>
                                    <th>AMOUNT</th>
                                    <th style="width: 200px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $i =  1; @endphp

                                    @forelse ($invoices as $invoice)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ ucwords($invoice->id) }}</td>
                                            <td>{{ $invoice->customer_id }}</td>
                                            <td>{{ $invoice->total_amount }}</td>
                                            <td>{{ $invoice->total_amount }}</td>
                                            <td>{{ $invoice->total_amount }}</td>
                                            <td>
                                                <a href="{{ route('invoice.show',$invoice->id) }}" class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('invoice.edit',$invoice->id) }}" class="btn btn-sm btn-info">Edit</a>
{{--                                                <a href="{{ route('invoice.pdf',$invoice->id) }}" class="btn btn-sm btn-warning">View PDF</a>--}}
                                                <form method="POST" action="{{ route('buyers.destroy', $invoice->id) }}"
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
                                            <td colspan="6" class="text-center">{{ __('No data Found...') }}</td>
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

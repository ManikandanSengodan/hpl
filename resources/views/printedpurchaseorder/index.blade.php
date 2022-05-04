@extends('adminlte::page')

@section('title', 'Purchase Order')

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
                        <h3 class="card-title">Printed Purchase Order</h3>
                        <div class="float-right">
                            <a href="{{ route('printed.purchaseorder.create') }}" class="btn bg-gradient-primary float-right">Add Purchase Order</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-sm table-striped table-bordered action-hide" id="list-datatable">
                            <thead>
                            <tr>
                                <th style="width: 100px">S.No</th>
                                <th>Customer</th>
                                <th>Label</th>
                                <th>Design No</th>
                                <th>Sales Representative</th>
                                <th>Created On</th>
                                <th style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = ($purchaseOrders->currentpage()-1)* $purchaseOrders->perpage() + 1; @endphp
                                @forelse ($purchaseOrders as $purchaseOrder)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ($purchaseOrder->designCard && $purchaseOrder->designCard->customerDetail) ? ucwords($purchaseOrder->designCard->customerDetail->company_name) : '-'}}</td>
                                        <td>{{ $purchaseOrder->designCard ? ucwords($purchaseOrder->label) : '-'}}</td>
                                        <td>{{ isset($purchaseOrder->designCard->main_label['design_no']) ? $purchaseOrder->designCard->main_label['design_no'] : '-'}}</td>
                                        <td>{{ $purchaseOrder->designCard && $purchaseOrder->designCard->salesRepDetail  ? ucwords($purchaseOrder->designCard->salesRepDetail->name) : '-'}}</td>
                                        <td>{{ $purchaseOrder->designCard ? $purchaseOrder->designCard->date : '-' }}</td>
                                        
                                        <td>
                                            <a href="{{ route('printed.purchaseorder.show',$purchaseOrder->id) }}" class="btn btn-sm btn-warning">View</a>
                                            
                                            <a href="{{ route('printed.purchaseorder.edit',$purchaseOrder->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            
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

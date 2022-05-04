@extends('adminlte::page')

@section('title', 'Company Profile')

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
                            <h3 class="card-title">Company Profile</h3>
                            <div class="col-sm-6 float-right">
                                <a href="{{ route('company-profile.create') }}" class="btn bg-gradient-primary float-right">{{ __('Add Company Profile') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-hover table-sm table-striped table-bordered action-hide" id="list-datatable">
                                <thead>
                                <tr>
                                    <th style="width: 50px">S.No</th>
                                    <th>Company Name</th>
                                    <th>Mobile No</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th style="width: 200px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $i = ($profiles->currentpage()-1)* $profiles->perpage() + 1; @endphp

                                    @forelse ($profiles as $profile)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ ucwords($profile->company_name) }}</td>
                                            <td>{{ $profile->mobile_no }}</td>
                                            <td>{{ $profile->email }}</td>
                                            <td>{{ $profile->type }}</td>
                                            <td>
                                                <a href="{{ route('company-profile.show',$profile->id) }}" class="btn btn-sm btn-warning">View</a>
                                                <a href="{{ route('company-profile.edit',$profile->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <form method="POST" action="{{ route('company-profile.destroy', $profile->id) }}"
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


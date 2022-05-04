@extends('adminlte::page')

@section('title', 'Loom Operator')

@section('content_header')
    <div class="row mb-1">
        <div class="offset-md-1 col-md-10">
            <h1 class="font-weight-bold float-left">
                {{ __('Loom Operator - ') . ucwords($loomoperator->name)}}
            </h1>
            <div class="float-right">
                <a href="{{ route('staffs.edit',$loomoperator->id) }}" class="btn bg-gradient-warning mr-2">{{ __('Edit') }}</a>
                <a href="{{ route('loomoperators.index') }}" class="btn bg-gradient-danger mr-2">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-1 col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Loom Operator Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>{{ __('Full Name') }}</strong></td>
                                        <td>{{ ucwords($loomoperator->name) }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Email') }}</strong></td>
                                        <td>{{ $loomoperator->email }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Phone') }}</strong></td>
                                        <td>{{ $loomoperator->phone }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Qualification') }}</strong></td>
                                        <td>{{ ucwords($loomoperator->qualification) }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Role') }}</strong></td>
                                        <td>{{ $loomoperator->roleDetial ? ucwords($loomoperator->roleDetial->name) : '-'}}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Blood Group') }}</strong></td>
                                        <td>{{ $loomoperator->blood_group ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Document ID') }}</strong></td>
                                        <td>{{ $loomoperator->documentID ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Document File') }}</strong></td>
                                        <td>
                                            @if($loomoperator->document_name)
                                                <a href="{{$loomoperator->document_name}}" download><i class="fas fa-download mr-2"></i>Download</a>
                                            @else
                                                No document files 
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Joined On') }}</strong></td>
                                        <td>{{ $loomoperator->joined_on }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Left On') }}</strong></td>
                                        <td>{{ $loomoperator->left_on ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Address') }}</strong></td>
                                        <td>{{ $loomoperator->address ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Status') }}</strong></td>
                                        <td>{{ $loomoperator->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop

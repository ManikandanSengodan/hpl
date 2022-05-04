@extends('adminlte::page')

@section('title', 'Designer')

@section('content_header')
    <div class="row mb-1">
        <div class="offset-md-1 col-md-10">
            <h1 class="font-weight-bold float-left">
                {{ __('Designer - ') . ucwords($staff->name)}}
            </h1>

        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="offset-md-1 col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Staff Details</h3>
                            <div class="float-right">
                                <a href="{{ route('staffs.edit',$staff->id) }}" class="btn bg-gradient-warning mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('staffs.destroy', $staff->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ url('stafflist/'.$staff->role_id) }}" class="btn bg-gradient-primary mr-2">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                <tr>
                                    <td><strong>{{ __('Name') }}</strong></td>
                                    <td>{{ ucwords($staff->name) }}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Email') }}</strong></td>
                                    <td>{{ $staff->email }}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Mobile No') }}</strong></td>
                                    <td>{{ $staff->phone }}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Qualification') }}</strong></td>
                                    <td>{{$staff->qualification ? ucwords($staff->qualification) : '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Role') }}</strong></td>
                                    <td>{{ $staff->roleDetial ? ucwords($staff->roleDetial->name) : '-'}}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Blood Group') }}</strong></td>
                                    <td>{{ $staff->blood_group ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Document ID') }}</strong></td>
                                    <td>{{ $staff->documentID ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Document File') }}</strong></td>
                                    <td>
                                        @if($staff->document_name)
                                            <a href="{{$staff->document_name}}" download><i class="fas fa-download mr-2"></i>Download</a>
                                        @else
                                            No document files
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Joined On') }}</strong></td>
                                    <td>{{ $staff->joined_on ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Left On') }}</strong></td>
                                    <td>{{ $staff->left_on ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Address') }}</strong></td>
                                    <td>{{ $staff->address ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>{{ __('Status') }}</strong></td>
                                    <td>{{ $staff->status == 1 ? 'Active' : 'Inactive' }}</td>
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

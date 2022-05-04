@extends('adminlte::page')

@section('title', 'Company Profile')

@section('content_header')
    <div class="row mb-0">
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Company Profile</h3>
                            <div class="float-right">
                                <a href="{{ route('company-profile.edit',$profile->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('company-profile.destroy', $profile->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('company-profile.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>{{ __('Company  Name') }}</strong></td>
                                        <td>{{ ucwords($profile->company_name) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Mobile No') }}</strong></td>
                                        <td>{{ $profile->mobile_no }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Email') }}</strong></td>
                                        <td>{{ ucwords($profile->email) }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('GSTIN') }}</strong></td>
                                        <td>{{ $profile->GSTIN }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Logo') }}</strong></td>
                                        <td><img src="{{ $profile->image }}" alt="image" width=80" height="80"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Type') }}</strong></td>
                                        <td>{{ $profile->type }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Account Name') }}</strong></td>
                                        <td>{{ $profile->account_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Account Number') }}</strong></td>
                                        <td>{{ $profile->account_no }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('IFSC Code') }}</strong></td>
                                        <td>{{ $profile->IFSCCode }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Bank & Branch Name') }}</strong></td>
                                        <td>{{ $profile->bank_and_branch_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('UPI ID') }}</strong></td>
                                        <td>{{ $profile->UPI_ID }}</td>
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

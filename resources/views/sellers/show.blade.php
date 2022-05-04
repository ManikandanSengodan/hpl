@extends('adminlte::page')

@section('title', 'Vendor Detail')

@section('content_header')
    <div class="row mb-1">
        <div class="offset-md-1 col-md-10">
            <h1 class="float-left ml-2 font-weight-bold">
                {{ __('Vendor - ') . ucwords($seller->full_name)}}
            </h1>

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
                            <h3 class="card-title">Vendor Detail</h3>
                            <div class="float-right">
                                <a href="{{ route('sellers.edit',$seller->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('sellers.destroy', $seller->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                        <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('sellers.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                
                                    <tr>
                                        <td><strong>{{ __('Name') }}</strong></td>
                                        <td>{{ ucfirst($seller->full_name) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Category') }}</strong></td>
                                        <td>{{ $seller->categoryMasterDetail ? ucfirst($seller->categoryMasterDetail->category_name) : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Email') }}</strong></td>
                                        <td>{{ $seller->email }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Mobile No') }}</strong></td>
                                        <td>{{ $seller->mobile_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Mobile') }}</strong></td>
                                        <td>{{ $seller->mobile }}</td>
                                    </tr>
                                  <tr>
                                        <td><strong>{{ __('Pan') }}</strong></td>
                                        <td>{{ $seller->pan }}</td>
                                    </tr>
                                 <tr>
                                        <td><strong>{{ __('GST No') }}</strong></td>
                                        <td>{{ $seller->GST }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Bank Name') }}</strong></td>
                                        <td>{{ ucwords($seller->bank_name) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Account Number') }}</strong></td>
                                        <td>{{ $seller->account_no }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('IFSC Code') }}</strong></td>
                                        <td>{{ $seller->IFSCCode }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Opening Balance') }}</strong></td>
                                        <td>{{ $seller->opening_balance }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Credit Balance') }}</strong></td>
                                        <td>{{ $seller->credit_balance }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Credit Period') }}</strong></td>
                                        <td>{{ $seller->credit_period }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Grade') }}</strong></td>
                                        <td>{{ $seller->grade }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><strong>{{ __('Billing Address') }}</strong></td>
                                        <td>{{ $seller->billing_address }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Shipping Address') }}</strong></td>
                                        <td>{{ $seller->shipping_address }}</td>
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

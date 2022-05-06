@extends('adminlte::page')

@section('title', 'Customer Detail')

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
                            <h3 class="card-title">{{ ucwords($buyer->full_name) }} Detail</h3>
                            @if(Auth()->User()->role_id != 2) 
                            <div class="float-right">
                              <a href="{{ route('customer.edit',$buyer->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('customer.destroy', $buyer->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('customer.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Back') }}</a>
                            </div>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>{{ __('Name') }}</strong></td>
                                        <td>{{ ucwords($buyer->full_name) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Code') }}</strong></td>
                                        <td>{{ ucwords($buyer->customer_code) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Primary Email') }}</strong></td>
                                        <td>{{ $buyer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Mobile') }}</strong></td>
                                        <td>{{ $buyer->mobile_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Pan') }}</strong></td>
                                        <td>{{ $buyer->pan }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('GST No') }}</strong></td>
                                        <td>    {{ $buyer->gst_no }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Customer Address') }}</strong></td>
                                        <td>{{ $buyer->customer_address }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Customer Region') }}</strong></td>
                                        <td>
                                            @if($buyer->customer_region == '1' ) East @endif
                                            @if($buyer->customer_region == '2' ) West @endif
                                            @if($buyer->customer_region == '3' ) North @endif
                                            @if($buyer->customer_region == '4' ) South @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Customer Group') }}</strong></td>
                                        <td>
                                            @if($buyer->customer_group == '1' ) Kolkata @endif
                                            @if($buyer->customer_group == '2' ) East Kolkata @endif
                                            @if($buyer->customer_group == '3' ) Chennai @endif
                                            @if($buyer->customer_group == '4' ) Delhi NCR  @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Sold to Party') }}</strong></td>
                                        <td>{{ $buyer->sold_party }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Ship_ to Party') }}</strong></td>
                                        <td>{{ $buyer->ship_party }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Bill to Prty') }}</strong></td>
                                        <td>{{ $buyer->bill_party }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Sales Office') }}</strong></td>
                                        <td>{{ $buyer->sales_office }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Payer Name') }}</strong></td>
                                        <td>{{ $buyer->payer_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Recon Account') }}</strong></td>
                                        <td>{{ $buyer->recon_account }}</td>
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

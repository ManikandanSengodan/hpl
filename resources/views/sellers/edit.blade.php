@extends('adminlte::page')

@section('title', 'Vendors')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Vendors - ') . $seller->first_name}}</h1>
        </div>

    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="offset-md-1 col-md-10">

                @include('shared.errors')

                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Update Vendors') }}</h3>
                            <div class="col-sm-6">
                                <a href="{{ route('sellers.index') }}" class="btn bg-gradient-primary float-right">{{ __('Back') }}</a>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('sellers.update', $seller->id) }}" novalidate>
                            @method('PUT')
                            @csrf
                            <div class="card-body row">
                            
                                <div class="form-group col-6">
                                    <label for="first_name">Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ $seller->first_name }}" placeholder="First Name">
                                    @error('first_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ $seller->last_name }}" placeholder="Last Name">
                                    @error('last_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $seller->email }}" placeholder="Email">
                                    @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="mobile_number">Mobile No</label>
                                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number" value="{{ $seller->mobile_number }}" placeholder="Mobile No">
                                    @error('mobile_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                    @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('qualification') is-invalid @enderror" id="status" name="status">
                                    <option value=1>Active </option>
                                    <option value=0>InActive </option>
                                    </select>
                                
                                    @error('status')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <h5 class="mt-4 mb-2 col-12">{{ _('Billing Address') }}</h5>
                                <div class="form-group col-12">
                                    <label for="billing_address">Billing Address</label>
                                    <textarea class="form-control @error('billing_address') is-invalid @enderror" id="billing_address" name="billing_address" >{{$seller->billing_address}}</textarea>
                                    
                                    @error('billing_address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h5 class="mt-4 mb-2 col-12">{{ _('Shipping Address') }}</h5>
                                <div class="form-group">
                                    <label for="same_as">Same as Billing Address</label>
                                    <input style="width:10%;margin-left: 45px;" type="checkbox" class="form-control @error('same_as') is-invalid @enderror" id="same_as" name="same_as" value="1">
                                    @error('same_as')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="shipping_address">Address</label>
                                    <textarea class="form-control @error('shipping_address') is-invalid @enderror" id="shipping_address" name="shipping_address" >{{$seller->shipping_address}}</textarea>
                                    
                                    @error('shipping_address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h5 class="mt-4 mb-2 col-12">{{ _('Other Details') }}</h5>
                                <div class="form-group col-6">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" value="{{ $seller->bank_name }}" placeholder="Bank Name">
                                    @error('bank_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="account_no">Account Number</label>
                                    <input type="text" class="form-control @error('account_no') is-invalid @enderror" id="account_no" name="account_no" value="{{ $seller->account_no }}" placeholder="Account Number">
                                    @error('account_no')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="IFSCCode">IFSC Code</label>
                                    <input type="text" class="form-control @error('IFSCCode') is-invalid @enderror" id="IFSCCode" name="IFSCCode" value="{{ $seller->IFSCCode }}" placeholder="IFSC Code">
                                    @error('IFSCCode')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="opening_balance">Opening Balance</label>
                                    <input type="text" class="form-control @error('opening_balance') is-invalid @enderror" id="opening_balance" name="opening_balance" value="{{ $seller->opening_balance }}" placeholder="Opening Balance">
                                    @error('opening_balance')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="credit_period">Credit Period</label>
                                    <input type="text" class="form-control @error('credit_period') is-invalid @enderror" id="credit_period" name="credit_period" value="{{ $seller->credit_period }}" placeholder="Credit Period">
                                    @error('credit_period')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="grade">Grade</label>
                                    <input type="text" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" value="{{ $seller->grade }}" placeholder="Grade">
                                    @error('grade')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

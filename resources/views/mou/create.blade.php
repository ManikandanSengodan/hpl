@extends('adminlte::page')

@section('title', 'Create Designer')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Create MOU') }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('mous.index') }}" class="btn bg-gradient-primary float-right">Back</a>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-1">

                    @foreach (['danger', 'warning', 'success', 'info'] as $message)
                        @if(Session::has($message))
                            <div class="alert alert-{{ $message }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session($message) }}
                            </div>
                    @endif
                @endforeach

                <!-- general form elements -->
                    <div class="card card-primary" style="width: 850px;" >
                        <div class="card-header">
                            <h3 class="card-title">Create MOU</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('mous.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-6">
                                    <label for="region">RO</label>
                                    <select class="form-control @error('region') is-invalid @enderror" id="region" name="region">
                                    <option value="ERO">ERO </option>
                                    </select>
                                
                                    @error('region')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="ship_to_party_code">Ship-to Party Code</label>
                                    <input type="text" class="form-control @error('ship_to_party_code') is-invalid @enderror" id="ship_to_party_code" name="ship_to_party_code" value="{{old('ship_to_party_code')}}" placeholder="ship-to party code">
                                    @error('ship_to_party_code')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="customer_id">Customer</label>
                                    <select class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->company_name}}</option>
                                   @endforeach
                                    </select>
                                
                                    @error('customer_id')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="group_company">Group Company</label>
                                    <input type="text" class="form-control @error('group_company') is-invalid @enderror" id="group_company" name="group_company" value="{{old('group_company')}}" placeholder="Group Company">
                                    @error('group_company')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="price_point">Price-Point</label>
                                    <select class="form-control @error('price_point') is-invalid @enderror" id="price_point" name="price_point">
                                    <option value="">Select Price point </option>
                                    <option value="WBS">WBS </option>
                                    <option value="WBS">AS </option>
                                    </select>
                                    @error('price_point')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="major_grade">Major Grade</label>
                                    <select class="form-control @error('major_grade') is-invalid @enderror" id="major_grade" name="major_grade">
                                    <option value="">Select Major Grade</option>
                                    <option value="71501s">71501s </option>
                                    <option value="WBS">71601w </option>
                                    </select>
                                    @error('major_grade')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="css_period">CSS Period</label>
                                    <select class="form-control @error('css_period') is-invalid @enderror" id="css_period" name="css_period">
                                    <option value="">Select CSS Period</option>
                                    <option value="71501s">71501s </option>
                                    <option value="WBS">71601w </option>
                                    </select>
                                    @error('css_period')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="mou_type">Type</label>
                                    <select class="form-control @error('mou_type') is-invalid @enderror" id="mou_type" name="mou_type">
                                    <option value="">Select Type </option>
                                    <option value="PE">PE </option>
                                    <option value="PP">PP </option>
                                    </select>
                                    @error('mou_type')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="monthly_rate">Monthly Rate</label>
                                    <input type="tel" class="form-control @error('monthly_rate') is-invalid @enderror" id="monthly_rate" name="monthly_rate" value="{{old('monthly_rate')}}" placeholder="Monthly Rate(INR)">
                                    @error('monthly_rate')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="quarterly_rate">Quarterly Rate</label>
                                    <input type="tel" class="form-control @error('quarterly_rate') is-invalid @enderror" id="quarterly_rate" name="quarterly_rate" value="{{old('quarterly_rate')}}" placeholder="Quarterly Rate(INR)">
                                    @error('quarterly_rate')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="annual_rate">Annual Rate</label>
                                    <input type="tel" class="form-control @error('annual_rate') is-invalid @enderror" id="annual_rate" name="annual_rate" value="{{old('annual_rate')}}" placeholder="Annual Rate(INR)">
                                    @error('annual_rate')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="monthly_target">Monthly Target</label>
                                    <input type="tel" class="form-control @error('monthly_target') is-invalid @enderror" id="monthly_target" name="monthly_target" value="{{old('monthly_target')}}" placeholder="Monthly Target">
                                    @error('monthly_target')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="quarterly_target">Quarterly Target</label>
                                    <input type="tel" class="form-control @error('quarterly_target') is-invalid @enderror" id="quarterly_target" name="quarterly_target" value="{{old('quarterly_target')}}" placeholder="Quarterly Target">
                                    @error('quarterly_target')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="annual_target">Annual Rate</label>
                                    <input type="tel" class="form-control @error('annual_target') is-invalid @enderror" id="annual_target" name="annual_target" value="{{old('annual_target')}}" placeholder="Annual Target">
                                    @error('annual_target')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="from_date">From On</label>
                                    <input type="date" class="form-control @error('from_date') is-invalid @enderror" id="from_date" value="{{old('from_date')}}" name="from_date" placeholder="From Date">
                                    @error('from_date')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="to_date">Left On</label>
                                    <input type="date" class="form-control @error('to_date') is-invalid @enderror" id="to_date" value="{{old('to_date')}}" name="to_date" placeholder="To Date">
                                    @error('to_date')
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
                                <div class="form-group col-6">
                                    <label for="address">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address')}}"></textarea>
                                    
                                    @error('address')
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
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
@stop

@extends('adminlte::page')
@if($editProfile)
@section('title', 'Edit Company Profile')
@else
@section('title', 'Create Company Profile')
@endif

@section('content_header')
    <div class="row mb-0">
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('shared.errors')
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            @if($editProfile)
                                <h3 class="card-title font-weight-bold">{{ __('Edit Company Profile') }}</h3>
                            @else
                                <h3 class="card-title font-weight-bold">{{ __('Create Company Profile') }}</h3>
                            @endif
                                <div class="float-right">
                                    @if($editProfile)
                                        <button onclick="submitForm()" class="btn bg-gradient-primary btn-md mr-2">{{ __('Update') }}</button>
                                        <a href="{{ route('company-profile.show', $editProfile->id) }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                    @else
                                        <a href="{{ route('company-profile.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                    @endif
                                </div>

                        </div>
                        <div class="card-body">
                            <form method="POST" id="submit_form" action="{{ $editProfile ? route('company-profile.update', $editProfile->id) : route('company-profile.store')  }}" enctype="multipart/form-data" novalidate>
                                @csrf
                                @if($editProfile) @method('PUT') @endif
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <h5 class="mb-3 font-weight-bold">{{ _('Profile Details') }}</h5>
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="company_name">Company Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ $editProfile ? old('company_name',$editProfile->company_name) : old('company_name') }}" placeholder="Customer Name">
                                                @error('company_name')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="mobile_no">Mobile No <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ $editProfile ? old('mobile_no',$editProfile->mobile_no) : old('mobile_no') }}" placeholder="Mobile No">
                                                @error('mobile_no')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $editProfile ? old('email',$editProfile->email) : old('email') }}" placeholder="Email">
                                                    @error('email')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="GSTIN">GSTIN <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('GSTIN') is-invalid @enderror" id="GSTIN" name="GSTIN" value="{{ $editProfile ? old('GSTIN',$editProfile->GSTIN) : old('GSTIN') }}" placeholder="GSTIN">
                                                @error('GSTIN')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="image">Company Logo @if(!$editProfile)<span class="text-danger">*</span>@endif</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ $editProfile ? old('email',$editProfile->email) : old('email') }}" placeholder="Logo">
                                                @error('image')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="type">Type <span class="text-danger">*</span></label>
                                                <select class="form-control @error('type') is-invalid @enderror"
                                                        id="type" name="type">
                                                    <option disabled selected>Select Type</option>
                                                    <option value="invoice" @if($editProfile && $editProfile->type == 'invoice') selected @endif>Invoice</option>
                                                </select>
                                                @error('type')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mt-3 ">
                                            <div class="form-group col-12">
                                                <label for="address">Address <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Address">{{ $editProfile ? old('address',$editProfile->address) : old('address') }} </textarea>
                                                @error('address')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <hr/>
                                        <div class="row">
                                            <h5 class="mt-2 col-12 font-weight-bold">{{ _('Bank Details') }}</h5>
                                            <div class="form-group col-4 mt-3">
                                                <label for="account_name">Account Name  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('account_name') is-invalid @enderror" id="account_name" name="account_name" value="{{ $editProfile ? old('account_name',$editProfile->account_name) : old('account_name') }}" placeholder="Account Name">
                                                @error('account_name')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4 mt-3">
                                                <label for="account_no">Account Number  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('account_no') is-invalid @enderror" id="account_no" name="account_no" value="{{ $editProfile ? old('account_no',$editProfile->account_no) : old('account_no') }}" placeholder="Account Number">
                                                @error('account_no')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4 mt-3">
                                                <label for="IFSCCode">IFSC Code  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('IFSCCode') is-invalid @enderror" id="IFSCCode" name="IFSCCode" value="{{ $editProfile ? old('IFSCCode',$editProfile->IFSCCode) : old('IFSCCode') }}" placeholder="IFSC Code">
                                                @error('IFSCCode')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="bank_and_branch_name">Bank & Branch Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('bank_and_branch_name') is-invalid @enderror" id="bank_and_branch_name" name="bank_and_branch_name" value="{{ $editProfile ? old('bank_and_branch_name',$editProfile->bank_and_branch_name) : old('bank_and_branch_name') }}" placeholder="Bank & Branch Name">
                                                @error('bank_and_branch_name')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div> 
                                            <div class="form-group col-4">
                                                <label for="UPI_ID">UPI <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('UPI_ID') is-invalid @enderror" id="UPI_ID" name="UPI_ID" value="{{ $editProfile ? old('UPI_ID',$editProfile->UPI_ID) : old('UPI_ID') }}" placeholder="UPI ID">
                                                @error('UPI_ID')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <button type="submit" class="btn bg-gradient-primary btn-md mr-2 float-right">{{ $editProfile ? 'Update' : 'Save'}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script>
        function submitForm() {
            $('#submit_form').submit();
        }
    </script>
@stop

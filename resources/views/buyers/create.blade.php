@extends('adminlte::page')
@if($editCustomer)
@section('title', 'Edit Customer')
@else
@section('title', 'Create New Customer')
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
                            @if($editCustomer)
                                <h3 class="card-title font-weight-bold">{{ __('Edit Customer') }}</h3>
                            @else
                                <h3 class="card-title font-weight-bold">{{ __('Create Customer') }}</h3>
                            @endif
                                <div class="float-right">
                                    @if($editCustomer)
                                        <button onclick="submitForm()" class="btn bg-gradient-primary btn-md mr-2">{{ __('Update') }}</button>
                                        <a href="{{ route('customer.show', $editCustomer->id) }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                    @else
                                        <a href="{{ route('customer.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                    @endif
                                </div>

                        </div>
                        <div class="card-body">
                            <form method="POST" id="submit_form" action="{{ $editCustomer ? route('customer.update', $editCustomer->id) : route('customer.store')  }}" novalidate>
                                @csrf
                                @if($editCustomer) @method('PUT') @endif
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <h5 class="mb-3 font-weight-bold">{{ _('Customer Details') }}</h5>
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="customer_name">Customer Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ $editCustomer ? old('company_name',$editCustomer->company_name) : old('company_name') }}" placeholder="Customer Name">
                                                @error('customer_name')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="group_company">Group Company <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('group_company') is-invalid @enderror" id="company_phone" name="group_company" value="{{ $editCustomer ? old('group_company',$editCustomer->company_phone) : old('group_company') }}" placeholder="Group Company">
                                                @error('group_company')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="customer_code">Customer Code<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('customer_code') is-invalid @enderror" id="customer_code" name="customer_code" value="{{ $editCustomer ? old('customer_code',$editCustomer->company_phone) : old('customer_code') }}" placeholder="Customer Code" readonly>
                                                @error('customer_code')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $editCustomer ? old('company_name',$editCustomer->company_name) : old('company_name') }}" placeholder="Email">
                                                @error('email')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>                                            
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="customer_address">Address <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('customer_address') is-invalid @enderror" id="customer_address" name="customer_address">{{ $editCustomer ? old('customer_address',$editCustomer->billing_address) : old('customer_address') }}</textarea>
                                                @error('customer_address')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="mobile_number">Mobile and Lan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number" value="{{ $editCustomer ? old('mobile',$editCustomer->mobile) : old('mobile') }}" placeholder="Mobile">
                                                @error('mobile_number')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="pan">PAN <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('pan') is-invalid @enderror" id="pan" name="pan" value="{{ $editCustomer ? old('pan',$editCustomer->pan) : old('pan') }}" placeholder="PAN">
                                                @error('pan')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="gst_no">GSTIN <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('gst_no') is-invalid @enderror" id="gst_no" name="GST" value="{{ $editCustomer ? old('graGSTde',$editCustomer->GST) : old('GST') }}" placeholder="GSTIN">
                                                @error('gst_no')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="form-group col-4">
                                                <label for="status">Region</label>
                                                <select class="form-control @error('customer_region') is-invalid @enderror" id="customer_region" name="customer_region">
                                                   <option value="" selected disabled>Select</option>
                                                   <option value="1">East</option>
                                                   <option value="2">West</option>
                                                   <option value="3">South</option>
                                                   <option value="4">North</option>
                                                </select>
                                                @error('customer_region')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="status">Customer Group</label>
                                                <select class="form-control @error('customer_group') is-invalid @enderror" id="customer_group" name="customer_group">
                                                   <option value="" selected disabled>Select</option>
                                                   <option value="1">Kolkata</option>
                                                   <option value="2">East Kolkata</option>
                                                   <option value="3">Chennai</option>
                                                   <option value="4">Delhi NCR</option>
                                                </select>
                                                @error('customer_group')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="status">Status</label>
                                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                    @if($editCustomer)
                                                        <option value='1' {{ old('status') == '1' ? 'selected' : ($editCustomer->status == '1' ? 'selected' : '') }}>Active </option>
                                                        <option value='0' {{ old('status') == '0' ? 'selected' : ($editCustomer->status == '0' ? 'selected' : '') }}>InActive </option>
                                                    @else
                                                        <option value='1' {{ old('status') == "1" ? 'selected' : '' }}>Active </option>
                                                        <option value='0' {{ old('status') == "0" ? 'selected' : '' }}>InActive </option>
                                                    @endif
                                                </select>
                                                @error('status')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <hr/>
                                     
                                        <div class="row">
                                            <h5 class="mt-2 col-12 font-weight-bold">{{ _('Other Details') }}</h5>
                                            <div class="form-group col-12 mt-3">
                                                <label for="sales_office">Sales office</label>
                                                <input type="text" class="form-control @error('sales_office') is-invalid @enderror" id="sales_office" name="sales_office" value="{{ $editCustomer ? old('account_no',$editCustomer->account_no) : old('account_no') }}" placeholder="Sales Office">
                                                @error('sales_office')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4 mt-3">
                                                <label for="sold_party">Sold to Party</label>
                                                <input type="text" class="form-control @error('sold_party') is-invalid @enderror" id="sold_party" name="sold_party" value="{{ $editCustomer ? old('IFSCCode',$editCustomer->IFSCCode) : old('sold_party') }}" placeholder="Sold to Party">
                                                @error('sold_party')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4 mt-3">
                                                <label for="ship_party">Ship to Party</label>
                                                <input type="text" class="form-control @error('ship_party') is-invalid @enderror" id="ship_party" name="ship_party" value="{{ $editCustomer ? old('IFSCCode',$editCustomer->IFSCCode) : old('IFSCCode') }}" placeholder="Ship to Party">
                                                @error('ship_party')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4 mt-3">
                                                <label for="bill_party">Bill to Party</label>
                                                <input type="text" class="form-control @error('bill_party') is-invalid @enderror" id="bill_party" name="bill_party" value="{{ $editCustomer ? old('IFSCCode',$editCustomer->IFSCCode) : old('IFSCCode') }}" placeholder="Bill to Party">
                                                @error('bill_party')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr/>
                                        <br>    

                                        <div class="row">
                                            <h5 class="mt-2 col-12 font-weight-bold">{{ _('Payer Details') }}</h5>
                                            <div class="form-group col-4 mt-3">
                                                <label for="payer">Payer</label>
                                                <input type="text" class="form-control @error('payer') is-invalid @enderror" id="payer" name="payer" value="{{ $editCustomer ? old('IFSCCode',$editCustomer->IFSCCode) : old('sold_party') }}" placeholder="Payer">
                                                @error('payer')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4 mt-3">
                                                <label for="payer_name">Payer Name</label>
                                                <input type="text" class="form-control @error('payer_name') is-invalid @enderror" id="payer_name" name="payer_name" value="{{ $editCustomer ? old('IFSCCode',$editCustomer->IFSCCode) : old('IFSCCode') }}" placeholder="Payer Name">
                                                @error('payer_name')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-4 mt-3">
                                                <label for="recon_account">Recon Account</label>
                                                <input type="text" class="form-control @error('recon_account') is-invalid @enderror" id="recon_account" name="recon_account" value="{{ $editCustomer ? old('IFSCCode',$editCustomer->IFSCCode) : old('IFSCCode') }}" placeholder="Recon Account">
                                                @error('recon_account')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <br>
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="password">Password @if(!$editCustomer)<span class="text-danger">*</span>@endif</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                                @error('password')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="password_confirmation">Confirm Password @if(!$editCustomer)<span class="text-danger">*</span>@endif</label>
                                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                                @error('password_confirmation')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <button type="submit" class="btn btn-primary btn-lg col-2 float-right">{{ $editCustomer ? 'Update' : 'Save'}}</button>
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
        $(document).ready(function () {
            $("#same_as").on("change", function(){
                let billingAddress      = $("#billing_address");
                let shippingAddress     = $("#shipping_address");
                var billingAddressValue = billingAddress.val();
                if(this.checked)
                {
                    $(this).prop('checked',true);
                    billingAddress.val()
                    if(billingAddressValue != "")
                    {
                        shippingAddress.val(billingAddressValue);
                    }
                    else
                    {
                        alert("Sorry Billing address field is empty");
                        billingAddress.focus();
                        $(this).prop('checked', false);
                    }
                }
                else
                {
                    shippingAddress.val("");
                }
            });
        });

        function submitForm() {
            $('#submit_form').submit();
        }
    </script>
@stop

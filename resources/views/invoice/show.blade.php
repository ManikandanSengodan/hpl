@extends('adminlte::page')
@section('title', 'Invoice Details')

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
                                <h3 class="card-title font-weight-bold">{{ __('Invoice Details') }}</h3>
                            <div class="float-right">
                                <a href="{{ route('invoice.edit', $editInvoice->id) }}" class="btn bg-gradient-warning btn-md mr-2">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('invoice.destroy', $editInvoice->id) }}"
                                      accept-charset="UTF-8"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn bg-gradient-danger btn-md mr-2" type="submit" value="Delete">
                                </form>
                                <a href="{{ route('invoice.index') }}" class="btn bg-gradient-primary btn-md mr-2 float-right">{{ __('Back') }}</a>
                            </div>

                        </div>
                        <div class="card-body">
                            <form method="POST" id="submit_form" action="{{ $editInvoice ? route('invoice.update', $editInvoice->id) : route('invoice.store')  }}" novalidate>
                                @csrf
                                @if($editInvoice) @method('PUT') @endif
                                 <table class="table">

                                        <tr>
                                
                                            <td style="width:50%" class="logofield borderright">
                                
                                                <table class="table">
                                
                                                    <tr>
                                
                                                        <td style="width:30%" class="textleft">
                                
                                                        <!-- <img  src="{{url('../img/hilife.png')}}"> -->
                                                            <img src="{{ $companyProfile->image ? $companyProfile->image : '/img/hilife.png' }}" alt="image" width="150" height="150">
                                
{{--                                                            <h1>IMG</h1>--}}
                                
                                                        </td>
                                                        <td style="width:70%">
                                                            <p class="HiLifeLabels">{{ $companyProfile->company_name }}</p>
                                                            <p class="address">{{ $companyProfile->address }}</p>
                                
                                
                                                            <table class="emailphone" style="margin-top: 5px;">
                                
                                                                <tr>
                                                                    <td><p><b>Email</b></p></td>
                                                                    <td><p>:</p></td>
                                                                    <td><p>{{ $companyProfile->email }}</p></td>
                                                                </tr>
                                
                                                                <tr>
                                                                    <td><p><b>GSTIN</b></p></td>
                                                                    <td><p>:</p></td>
                                                                    <td><p>{{ $companyProfile->GSTIN }}</p></td>
                                                                </tr>
                                
                                                                <tr>
                                                                    <td><p><b>Mobile</b></p></td>
                                                                    <td><p>:</p></td>
                                                                    <td><p>{{ $companyProfile->mobile_no }}</p></td>
                                                                </tr>
                                
                                                            </table>
                                
                                
                                                        </td>
                                
                                
                                                    </tr>
                                
                                                </table>
                                
                                            </td>
                                
                                            <td style="width:50%">
                                
                                                <table>
                                
                                                    <tr>
                                
                                                        <td><p class="taxinvoice">TAX INVOICE</p></td>
                                                        <td><p class="originalfor">ORIGINAL FOR RECIPIENT</p></td>
                                
                                                    </tr>
                                
                                                </table>
                                
                                
                                                <table class="table invoicedetails">
                                                     <tr>
                                                        <td class="textleft"><p>Invoice Number :</p></td>
                                                        <td class="textright"><p>{{$editInvoice ? $editInvoice->invoice_no : '' }} </p></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="textleft"><p>Invoice Date :</p></td>
                                                        <td class="textright"><p>{{$editInvoice ? $editInvoice->invoice_date  : '' }} </p></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="textleft"><p>Due Date :</p></td>
                                                        <td class="textright"><p> {{$editInvoice ? $editInvoice->due_date : '' }}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="textleft"><p>PO No :</p></td>
                                                        <td class="textright"><p> {{$editInvoice ? $editInvoice->po_no : '' }}</p></td>
                                                    </tr>
                                
                                                </table>
                                
                                
                                            </td>
                                
                                        </tr>
                                
                                    </table>
                                
                                
                                    <!------   customer Details ------>
                                
                                
                                    <table class="table bggray">
                                
                                        <tr>
                                
                                            <td style="width:50%"><p class="billheading">BILL TO</p></td>
                                            <td style="width:50%"><p class="shipheading">SHIP TO</p></td>
                                        </tr>
                                
                                    </table>
                                
                                
                                    <table class="table">
                                
                                        <tr>
                                
                                            <td style="width:50%" class="borderright">
                                                <p><b>{{ $editInvoice->customerDetail->company_name }}</b></p>
                                                <p>{{ $editInvoice->customerDetail->billing_address }}</p>
                                                <p><b>GSTIN : </b>{{ $editInvoice->customerDetail->GST }}</p>

                                            </td>
                                
                                            <td style="width:50%">
                                                <p>{{ $editInvoice->customerDetail->shipping_address }}</p>
                                            </td>
                                        </tr>
                                
                                    </table>
                                    <table class="table bggray">
                                
                                        <tr>
                                
                                            <td style="width:10%"><p class="billheading">S.No</p></td>
                                            <td style="width:20%"><p class="shipheading">ITEMS</p></td>
                                            <td style="width:10%"><p class="shipheading">HSN</p></td>
                                            <td style="width:10%"><p class="shipheading">DC NO</p></td>
                                            <td style="width:10%"><p class="shipheading">QTY</p></td>
                                            <td style="width:10%"><p class="shipheading">RATE</p></td>
                                            <td style="width:10%"><p class="shipheading">DISCOUNT</p></td>
                                            <td style="width:10%"><p class="shipheading">TAX</p></td>
                                            <td style="width:10%"><p class="shipheading">AMOUNT</p></td>
                                        </tr>
                                    </table>
                                
                                
                                    <table class="table itemsdata" id="items" >
                                        @if($editInvoice && $editInvoice->items)
                                        @foreach($editInvoice->items as $key => $item)
                                        <tr class="txtMult">
                                            
                                            {{-- {{dd($editInvoice->items)}} --}}
                                            <td style="width:10%"><p>{{ $key }}</p></td>
                                            <td style="width:20%"><p/>{{$item->item_name}}</p></td>
                                            <td style="width:10%"><p/>{{$item->hsn}}</p></td>
                                            <td style="width:10%"><p/>{{$item->dc_no}}</p></td>
                                            <td style="width:10%"><p/>{{$item->qty}}</p></td>
                                            <td style="width:10%"><p/>{{$item->rate}}</p></td>
                                            <td style="width:10%"><p/>{{$item->discount}}</p></td>
                                            <td style="width:10%"><p/>{{$item->tax}}</p></td>
                                            <td style="width:10%"><p/>{{$item->amount}}</p></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        
                                        </table>
                                        <table class="table itemsdata">
                                
                                        <tr>
                                            <td colspan="8">
                                
                                                <table class="table bggray">

                                                    <tr>

                                                        <td style="width:60%"><p class="">Total</p></td>
                                                        <td style="width:10%"><p class=""><p>  {{ $editInvoice->sum_rate}}</p></td>
                                                        <td style="width:10%"></td>
                                                        <td style="width:10%"><p class=""><p> {{ $editInvoice->sum_tax}}</p></td>
                                                        <td style="width:10%"><p class=""><p>{{ $editInvoice->sum_amount }}</p></td>
                                                    </tr>
                                                </table>
                                
                                            </td>
                                        </tr>
                                
                                    </table>
                                
                                
                                
                                    <table class="table">
                                
                                        <tr>
                                
                                
                                            <td style="width:60%" class="borderright">
                                                @if($editInvoice && $editInvoice->notes)
                                                <div id="div_notes" style="">
                                                    <div>
                                                        <label>Notes :</label>
                                                    </div>
                                                    <p>{{ $editInvoice->notes }}</p>
                                                </div>
                                                @endif

                                                <p>&nbsp;</p>
                                            	<table class="table bankdetails">
                                
                                                    <tr>
                                                        <td style="width:100%"   colspan="4"><p><b>Bank Details</b><br></p></td>
                                                    </tr>
                                
                                                    <tr>
                                                        <td style="width:30%"><p>Name</p></td>
                                                        <td style="width:5%"><p></p></td>
                                                        <td style="width:30%"><p>{{ $companyProfile->account_name }} </p></td>
                                                        <td style="width:35%"><p>&nbsp;</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%"><p>IFSC Code</p></td>
                                                        <td style="width:5%"><p></p></td>
                                                        <td style="width:30%"><p>{{ $companyProfile->IFSCCode }} </p></td>
                                                        <td style="width:35%"><p>&nbsp;</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%"><p>Account Number</p></td>
                                                        <td style="width:5%"><p></p></td>
                                                        <td style="width:30%"><p>{{ $companyProfile->account_no }} </p></td>
                                                        <td style="width:35%"><p>&nbsp;</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%"><p>Bank & Branch Name</p></td>
                                                        <td style="width:5%"><p></p></td>
                                                        <td style="width:30%"><p>{{ $companyProfile->bank_and_branch_name }} </p></td>
                                                        <td style="width:35%"><p>&nbsp;</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:30%"><p>UPI ID</p></td>
                                                        <td style="width:5%"><p></p></td>
                                                        <td style="width:30%"><p>{{ $companyProfile->UPI_ID }} </p></td>
                                                        <td style="width:35%"><p>&nbsp;</p></td>
                                                    </tr>
                                
                                                     <tr>
                                                        <td style="width:100%" colspan="4"><p><br></p></td>
                                                    </tr>
                                
                                                    <tr>
                                                        <td style="width:100%" colspan="4"><p><b>TERMS AND CONDITIONS<b><br></p></td>
                                                    </tr> 
                                
                                                    <tr>
                                                        <td style="width:100%" colspan="4">
                                                        <p>1.Interest will be charged at 18% on invoice value if not paid within 30 days.</p>
                                                        <p>2.Goods once sold cannot be taken back under any circumstances. </p>
                                                        <p>3.Goods are carefully checked and are consigned at your risk.</p>
                                                        <p>4.We are not responsible for any loss or damage during transit. </p>
                                                        <p>5.No legal proceedings entertained.</p>
                                                    </td>
                                                    </tr>
                                				</table>
                                            </td>
                                
                                
                                
                                
                                            <td style="width:40%">
                                            
                                                <table id="add_charge">
                                                    @if($editInvoice && $editInvoice->aditional_charge )
                                                        <tr>
                                                            <td>
                                                                <label>Additional charge</label>
                                                            </td>
                                                        </tr>
                                                    @foreach($editInvoice->aditional_charge as $j => $add)

                                                    <tr>
                                                        <td style="width:50%"><p class="textright"><p>{{$add->name}}</p></td>
                                                        <td style="width:50%"><p class="textright"><p>{{$add->value}}</p></td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </table>
                                            <table class="table bankdetails" >
                                            @if($editInvoice && $editInvoice->overall_discount)
                                            <tr>
                                                <td style="width: 10%">Additonal percentage</td>
                                                <td style="width: 60%">
                                                    <div class="discount">
                                                        <p>{{$editInvoice->overall_discount}}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            @else
                                            @endif
                                
                                	        <tr>
                                	            <td style="width:60%"><p class="textright"><b>Total</b></p></td>
                                                <td style="width:28%"><p class="textright"><p>{{$editInvoice->total_amount }} </p></td>
                                	        </tr>
                                
                                	        <tr>
                                	            <td style="width:60%"><p class="textright">Received Amount</p></td>
                                                <td style="width:28%"><p class="textright"><p>{{ $editInvoice->recived_amount }}</p></td>

                                	        </tr>
                                
                                	        <tr>
                                	            <td style="width:60%"><p class="textright"><b>Balance</b></p></td>
                                                <td style="width:28%"><p class="textright"><p>{{ $editInvoice->balance_amount}} </p></td>

                                	        </tr>
                                
                                           <tr>
                                	            <td style="width:50%"><p class="textright">Previous Balance</p></td>
                                               <td style="width:50%"><p class="textright"><p>{{ $editInvoice->previous_balance}}</p></td>

                                	        </tr>
                                
                                	        <tr>
                                	            <td style="width:50%"><p class="textright">Current Balance</p></td>
                                                <td style="width:50%"><p class="textright"><p>{{ $editInvoice->current_balance  }}</p></td>

                                	        </tr>
                                            <tr>
                                                <td style="width:100%"><p class="textright">Invoice Amount(in words)</p></td>
                                	        </tr>
                                           <tr>
                                                <td style="width:100%" colspan="4"><p class="textright">Forty Six Thousand Three Hundred</p></td>
                                	        </tr>
                                           <tr>
                                                <td style="width:100%" colspan="4"><p class="textright"><br><br>Authorised Signature for Hi Life Labels</p></td>
                                	        </tr>
                                            </table>
                                            </td>

                                        </tr>
                                
                                    </table>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@extends('adminlte::page')
@if($editInvoice)
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
                            @if($editInvoice)
                                <h3 class="card-title font-weight-bold">{{ __('Edit Invoice') }}</h3>
                            @else
                                <h3 class="card-title font-weight-bold">{{ __('Create Invoice') }}</h3>
                            @endif
                                <div class="float-right">
                                    @if($editInvoice)
                                        <button onclick="submitForm()" class="btn bg-gradient-primary btn-md mr-2">{{ __('Update') }}</button>
                                        <a href="{{ route('invoice.show', $editInvoice->id) }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                    @else
                                        <a href="{{ route('invoice.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                    @endif
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
                                                        <td class="textleft"><p>Invoice Number</p></td>
                                                        <td class="textright"><input class="form-controll" type="text" name="invoice_id" value="{{$editInvoice ? $editInvoice->invoice_no : '' }}"> </input></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="textleft"><p>Invoice Date</p></td>
                                                        <td class="textright"><input class="form-controll" type="date" name="invoice_date" value="{{$editInvoice ? $editInvoice->invoice_date  : '' }}"> </input></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="textleft"><p>Due Date</p></td>
                                                        <td class="textright"><input class="form-controll" type="date" name="due_date" value="{{$editInvoice ? $editInvoice->due_date : '' }}" > </input></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="textleft"><p>PO No:</p></td>
                                                        <td class="textright"><input class="form-controll" type="text" name="po_no" value="{{$editInvoice ? $editInvoice->po_no : '' }}"> </input></td>
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
                                                 <select class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                                                            <option value="">Select Customer</option>
                                                            @foreach( $customerMaster as $customer)
                                                                @if($editInvoice)
                                                                    <option data-val="{{json_encode($customer)}}" value="{{$customer['id']}}" {{ old('customer_id') == $customer['id'] ? 'selected' : ($customer['id'] == $editInvoice->customer_id ? 'selected' : '') }}>{{ucfirst($customer['company_name'])}} </option>
                                                                
                                                                @else
                                                                    <option data-val="{{json_encode($customer)}}"  value="{{$customer['id']}}" {{ old('customer_id') == $customer['id'] ? 'selected' : '' }}>{{ucfirst($customer['company_name'])}} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                        <p class="bill_address billtoadd"></p>
                                
                                            </td>
                                
                                            <td style="width:50%">
                                                <br>
                                                <p class="ship_address billtoadd"></p>
                                
                                
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
                                            <td style="width:20%"><input class="form-control" style="border: none; background: #fff" name="{{'new_row['.($key).'][item_name]'}}" value="{{$item->item_name}}" readonly/></td>
                                            <td style="width:10%"><input class="form-control" name="{{'new_row['.($key).'][hsn]'}}" value="{{$item->hsn}}"/></td>
                                            <td style="width:10%"><input class="form-control" name="{{'new_row['.($key).'][dc_no]'}}" value="{{$item->dc_no}}"/></td>
                                            <td style="width:10%"><input class="form-control item_qty quan" name="{{'new_row['.($key).'][qty]'}}" value="{{$item->qty}}"/></td>
                                            <td style="width:10%"><input class="form-control item_price price" name="{{'new_row['.($key).'][rate]'}}" value="{{$item->rate}}"/></td>
                                            <td style="width:10%"><input class="form-control item_discount disabled" name="{{'new_row['.($key).'][discount]'}}" value="{{$item->discount}}"/></td>
                                            <td style="width:10%"><input class="form-control item_tax " name="{{'new_row['.($key).'][tax]'}}" value="{{$item->tax}}"/></td>
                                            <td style="width:10%"><input class="form-control item_amunt amt" name="{{'new_row['.($key).'][amount]'}}" value="{{$item->amount}}" /></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        
                                        </table>
                                        <table class="table itemsdata">
                                            
                                        <tr>
                                
                                            <td colspan="2"><p class="">
                                                
                                                 <select class="form-control" id="addItem" name="design_card_id">
                                                            <option value="">Add Item</option>
                                                            @foreach( $DesignCard as $card)
                                                                
                                                                    <option value="{{json_encode($card)}}" >{{ucfirst($card['label'])}} </option>
                                                                
                                                            @endforeach
                                                        </select>
                                                
                                            </td>
                                            <td style="width:10%"><p class=""></p></td>
                                            <td style="width:10%"><p class=""></p></td>
                                            <td style="width:10%"><p class=""></p></td>
                                            <td style="width:10%"><p class=""></p></td>
                                            <td style="width:10%"><p class=""></p></td>
                                            <td style="width:10%"><p class=""></p></td>
                                        </tr>
                                
                                        <tr>
                                            <td colspan="8">
                                
                                                <table class="table bggray">
                                
                                                    <tr>
                                
                                                        <td style="width:60%"><p class="">Total</p></td>
                                                        <td style="width:10%"></td>
                                                        <td style="width:10%"><p class=""><input class="form-control item_total_discount " name="sum_rate" value="{{ $editInvoice ? $editInvoice->sum_rate : '' }}"/></p></td>
                                                        <td style="width:10%"><p class=""><input class="form-control item_total_tax " name="sum_tax" value="{{ $editInvoice ? $editInvoice->sum_tax : '' }}"/></p></td>
                                                        <td style="width:10%"><p class=""><input class="form-control item_total_amount " name="sum_amount" value="{{ $editInvoice ? $editInvoice->sum_amount : '' }}"/></p></td>
                                                    </tr>
                                                </table>
                                
                                            </td>
                                        </tr>
                                
                                    </table>
                                
                                
                                
                                    <table class="table">
                                
                                        <tr>
                                
                                
                                            <td style="width:60%" class="borderright">

                                                <div id="buttonAddNotes" @if($editInvoice && $editInvoice->notes)style="display: none" @endif>
                                                    <a style="color: #0c84ff" id="addNotes" onclick="addNotes()"><b>+
                                                            Add Notes</b></a>
                                                </div>
                                                @if($editInvoice && $editInvoice->notes)
                                                <div id="div_notes" style="">
                                                    <div>
                                                        <label>Notes :</label>
                                                        <a class="float-right" id="removeNotes" onclick="removeNotes()"><b>&#10006</b></a>
                                                    </div>
                                                    <input type="text" id="notes" name="notes" value="{{ $editInvoice ? $editInvoice->notes : old('notes') }}" class="col-md-12"
                                                           placeholder="Add notes here..." required="required"/>
                                                </div>
                                                @elseif(($editInvoice && !$editInvoice->notes) || !$editInvoice)
                                                    <div id="div_notes"  style="display: none">
                                                        <div>
                                                            <label>Notes :</label>
                                                            <a class="float-right" id="removeNotes" onclick="removeNotes()"><b>&#10006</b></a>
                                                        </div>
                                                        <input type="text" id="notes" name="notes" value="{{ $editInvoice ? $editInvoice->notes : old('notes') }}" class="col-md-12"
                                                               placeholder="Add notes here..." required="required"/>
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
                                                    @foreach($editInvoice->aditional_charge as $j => $add)
                                               
                                                    <tr>
                                                        <td colspan="2" style="width:60%"><p class="textright"><input class="form-control" name="{{'additional_charge['.$j.'][name]'}}" value="{{$add->name}}"/></p></td>
                                                        <td colspan="2" style="width:40%"><p class="textright"><input class="form-control add_charge" name="{{'additional_charge['.$j.'][value]'}}" value="{{$add->value}}"/></p></td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </table>
                                            <table class="table bankdetails" >
                                            <td colspan="3">
                                                <a style="color: #0c84ff" id="addAdditionalCharge"
                                                                    onclick="addAdditionalCharge()"><b>+
                                                        Add Additional charge</b></a>
                                                <label id="add_charge" style="display: none">Additional charge</label>
                                            </td>
                                            @if($editInvoice && $editInvoice->overall_discount)
                                            <tr>
                                                <td style="width: 10%">Additonal percentage</td>
                                                <td style="width: 60%">
                                                    <div class="discount">
                                                        <input class="form-control" placeholder="Percentage" id="discount_percentage" name="overall_discount_percentage" value="{{$editInvoice->overall_discount}}">
                                                    </div>
                                                </td>
                                                <td style="width: 2%" class="float-right">
                                                    <div class="discount">
                                                        <a id="removeAdditional" onclick="removeAdditional()"><b>&#10006</b></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td style="width: 10%">
                                                    <a style="color: #0c84ff" id="addAddtional"
                                                                        onclick="addAdditional()"><b>+
                                                            Add Discount</b></a>
                                                    <label id="discount_lable" style="display: none">Discount</label>
                                                </td>
                                                <td style="width: 60%">
                                                    <div class="discount">
                                                        <input class="form-control" placeholder="Percentage" id="discount_percentage" name="overall_discount_percentage" style="display: none">
                                                    </div>
                                                </td>
                                                <td style="width: 2%" class="float-right">
                                                    <div class="discount">
                                                        <a id="removeAdditional" style="display: none" onclick="removeAdditional()"><b>&#10006</b></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif

                                            {{-- <tr>
                                                <td style="width:10%"><p>&nbsp;</p></td>
                                	            <td style="width:60%"><p class="textright">Round Off</p></td>
                                                <td style="width:28%"><p class="textright"><input class="form-control"/></p></td>
                                	            <td style="width:2%"><p></p></td>
                                	        </tr> --}}
                                
                                	        <tr>
                                                <td style="width:10%"><p><br>&nbsp;<br></p></td>
                                	            <td style="width:60%"><p class="textright"><b>Total</b></p></td>
                                                <td style="width:28%"><p class="textright"><input class="form-control" id="sub_total" name="total_amount" value="{{$editInvoice ? $editInvoice->total_amount : '' }}"/> </p></td>
                                	            <td style="width:2%"><p></p></td>
                                	        </tr>
                                
                                	        <tr>
                                                <td style="width:10%"><p>&nbsp;</p></td>
                                	            <td style="width:60%"><p class="textright">Received Amount</p></td>
                                                <td style="width:28%"><p class="textright"><input class="form-control" id="recived_amount" name="received_amount" value="{{$editInvoice ? $editInvoice->recived_amount : '' }}"/> </p></td>
                                	            <td style="width:2%"><p></p></td>

                                	        </tr>
                                
                                	        <tr>
                                                <td style="width:10%"><p><br>&nbsp;<br></p></td>
                                	            <td style="width:60%"><p class="textright"><b>Balance</b></p></td>
                                                <td style="width:28%"><p class="textright"><input class="form-control" id="balance_amount" name="balance" value="{{$editInvoice ? $editInvoice->balance_amount : '' }}"/> </p></td>
                                	            <td style="width:2%"><p></p></td>

                                	        </tr>
                                
                                           <tr>
                                                <td style="width:10%"><p>&nbsp;</p></td>
                                	            <td style="width:60%"><p class="textright">Previous Balance</p></td>
                                               <td style="width:28%"><p class="textright"><input class="form-control" id="previous_balance" name="previous_balance" value="{{ $editInvoice ? $editInvoice->previous_balance : old('previous_balance') }}"/></p></td>
                                	            <td style="width:2%"><p></p></td>

                                	        </tr>
                                
                                	        <tr>
                                                <td style="width:10%"><p>&nbsp;</p></td>
                                	            <td style="width:60%"><p class="textright">Current Balance</p></td>
                                                <td style="width:28%"><p class="textright"><input class="form-control" id="current_balance" name="current_balance" value="{{ $editInvoice ? $editInvoice->current_balance : old('current_balance') }}"/> </p></td>
                                	            <td style="width:2%"><p></p></td>

                                	        </tr>
                                
                                            <tr>
                                            	<td style="width:0%"><p>&nbsp;</p></td>
                                	            <td style="width:0%"><p></p></td>
                                                <td style="width:100%"><p class="textright">Invoice Amount(in words)</p></td>
                                	            <td style="width:0%"><p></p></td>

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
                                <div class="row">
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary btn-md mr-2 float-right">{{ $editInvoice ? 'Update' : 'Save'}}</button>
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
            var index = 1;
            
            // $("#items input").on("input", function(){
            //     var mult = 0;
            //     $("tr.txtMult").each(function () {
            //         // get the values from this row:
            //         var $val1 = $('.quan', this).val();
            //         var $val2 = $('.price', this).val();
            //         var $val3 = $('.dis', this).val();
            //         if($val3){
            //             $val3 = ($val1 * $val2) * $val3 / 100;
            //         }
            //         var $total = ($val1 * $val2) - $val3 ;
            //         // set total for the row
            //         $('.amt', this).text($total);
            //         console.log($total,'23214153');
            //         mult += $total;
            //     });
            //     // $("#grandTotal").text(mult);
            // });
            
            $(document).on("input", ".item_qty", function() {
                    var sum = 0;
                   console.log( $(this).closest('tr').find('.item_qty').val());
                    $(this).closest('tr').find('.item_amunt').val(
                        (parseInt($(this).closest('tr').find('.item_qty').val())*
                        parseInt($(this).closest('tr').find('.item_price').val()))-
                        parseInt($(this).closest('tr').find('.item_discount').val())+
                        parseInt($(this).closest('tr').find('.item_tax').val()))
                    $(".item_amunt").trigger('change');
                });
                
                $(document).on("input", ".item_price", function() {
                    var sum = 0;
                   console.log( $(this).closest('tr').find('.item_qty').val());
                    $(this).closest('tr').find('.item_amunt').val(
                        (parseInt($(this).closest('tr').find('.item_qty').val())*
                        parseInt($(this).closest('tr').find('.item_price').val()))-
                        parseInt($(this).closest('tr').find('.item_discount').val())+
                        parseInt($(this).closest('tr').find('.item_tax').val()))
                    $(".item_amunt").trigger('change');
                });
                
                 $(document).on("input", ".item_price", function() {
                    var sum = 0;
                   console.log( $(this).closest('tr').find('.item_qty').val());
                    $(this).closest('tr').find('.item_amunt').val(
                        (parseInt($(this).closest('tr').find('.item_qty').val())*
                        parseInt($(this).closest('tr').find('.item_price').val()))-
                        parseInt($(this).closest('tr').find('.item_discount').val())+
                        parseInt($(this).closest('tr').find('.item_tax').val()))
                   $(".item_amunt").trigger('change');
                });
                
                 $(document).on("input", ".item_discount", function() {
                    var sum = 0;
                   console.log( $(this).closest('tr').find('.item_qty').val());
                    $(this).closest('tr').find('.item_amunt').val(
                        (parseInt($(this).closest('tr').find('.item_qty').val())*
                        parseInt($(this).closest('tr').find('.item_price').val()))-
                        parseInt($(this).closest('tr').find('.item_discount').val())+
                        parseInt($(this).closest('tr').find('.item_tax').val()))
                    $(".item_amunt").trigger('change');
                });
                
                $(document).on("input", ".item_tax", function() {
                    var sum = 0;
                   console.log( $(this).closest('tr').find('.item_qty').val());
                    $(this).closest('tr').find('.item_amunt').val(
                        (parseInt($(this).closest('tr').find('.item_qty').val())*
                        parseInt($(this).closest('tr').find('.item_price').val()))-
                        parseInt($(this).closest('tr').find('.item_discount').val())+
                        parseInt($(this).closest('tr').find('.item_tax').val()))
                    $(".item_amunt").trigger('change');
                });
                
                $(document).on("change", ".item_amunt", function() {
                    var sum = 0;
                     var tax = 0;
                      var discount = 0;
                        $(".item_amunt").each(function(){
                            sum += +$(this).val();
                        });
                        $(".item_tax").each(function(){
                            tax += +$(this).val();
                        });
                        $(".item_discount").each(function(){
                            discount += +$(this).val();
                        });
                        $(".item_total_amount").val(sum);
                        $(".item_total_tax").val(tax);
                        //item_total_discount
                         $(".item_total_discount").val(discount);
                });
                
                $(document).on("input", ".add_charge", function() {
                    var add_charge = 0;
                        $(".add_charge").each(function(){
                            add_charge += +$(this).val();
                        });
                      itemtotal =  $(".item_total_amount").val();
                      recived_amount = $("#recived_amount").val();
                      previous_balance = $("#previous_balance").val();
                      
                      $('#sub_total').val(
                          parseInt(add_charge)+
                          parseInt(itemtotal)
                          );
                      $('#sub_total').val(
                          parseInt(add_charge)+
                          parseInt(itemtotal)
                          ); 
                          $('#balance_amount').val(parseInt(add_charge)+
                          parseInt(itemtotal)-parseInt(recived_amount)
                          );
                       $('#current_balance').val(parseInt(add_charge)+
                          parseInt(itemtotal)-parseInt(recived_amount)+parseInt(previous_balance)
                          );    
                      
                      
                        
                });
                
                $(document).on("input", "#recived_amount", function() {
                    var add_charge = 0;
                        $(".add_charge").each(function(){
                            add_charge += +$(this).val();
                        });
                      itemtotal =  $(".item_total_amount").val();
                      recived_amount = $("#recived_amount").val();
                      previous_balance = $("#previous_balance").val();
                      
                      $('#sub_total').val(
                          parseInt(add_charge)+
                          parseInt(itemtotal)
                          );
                      $('#sub_total').val(
                          parseInt(add_charge)+
                          parseInt(itemtotal)
                          ); 
                          $('#balance_amount').val(parseInt(add_charge)+
                          parseInt(itemtotal)-parseInt(recived_amount)
                          );
                       $('#current_balance').val(parseInt(add_charge)+
                          parseInt(itemtotal)-parseInt(recived_amount)+parseInt(previous_balance)
                          );    
                      
                      
                        
                });
                
                $(document).on("input", "#previous_balance", function() {
                    var add_charge = 0;
                        $(".add_charge").each(function(){
                            add_charge += +$(this).val();
                        });
                      itemtotal =  $(".item_total_amount").val();
                      recived_amount = $("#recived_amount").val();
                      previous_balance = $("#previous_balance").val();
                      
                      $('#sub_total').val(
                          parseInt(add_charge)+
                          parseInt(itemtotal)
                          );
                      $('#sub_total').val(
                          parseInt(add_charge)+
                          parseInt(itemtotal)
                          ); 
                          $('#balance_amount').val(parseInt(add_charge)+
                          parseInt(itemtotal)-parseInt(recived_amount)
                          );
                       $('#current_balance').val(parseInt(add_charge)+
                          parseInt(itemtotal)-parseInt(recived_amount)+parseInt(previous_balance)
                          );    
                      
                      
                        
                });


            $("#customer_id").on("change", function(){
                 
                 //alert( this.value );
                 
                 customer = JSON.parse($(this).find(':selected').attr('data-val'));
                 $('.bill_address').html('<b>'+customer.company_name+'</b><br>'+'<b>'+customer.company_phone+'</b><br>'+customer.billing_address);
                 $('.ship_address').html('<b>'+customer.company_name+'</b><br>'+'<b>'+customer.company_phone+'</b><br>'+customer.shipping_address);
                 console.log(customer);
            });
             $("#addItem").on("change", function(){
                 
                 //alert( this.value );
                 design = JSON.parse(this.value);
                 var n1 = document.getElementById("items").rows.length + 1;
                 $('#items').append(`
                 <tr class="txtMult">
                                
                                            <td style="width:10%">`+n1+`</td>
                                            <td style="width:20%"><input class="form-control" style="border: none; background: #fff" name="new_row[`+n1+`][item_name]" value="`+design.label+`" readonly/></td>
                                            <td style="width:10%"><input class="form-control" name="new_row[`+n1+`][hsn]"/></td>
                                            <td style="width:10%"><input class="form-control" name="new_row[`+n1+`][dc_no]"/></td>
                                            <td style="width:10%"><input class="form-control item_qty quan" name="new_row[`+n1+`][qty]"/></td>
                                            <td style="width:10%"><input class="form-control item_price price" name="new_row[`+n1+`][rate]"/></td>
                                            <td style="width:10%"><input class="form-control item_discount disabled" name="new_row[`+n1+`][discount]"/></td>
                                            <td style="width:10%"><input class="form-control item_tax " name="new_row[`+n1+`][tax]"/></td>
                                            <td style="width:10%"><input class="form-control item_amunt amt" name="new_row[`+n1+`][amount]" /></td>
                                        </tr>
                 `);
                 index++;
                 
             });
            
            
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
        var add_index = 1;
        function submitForm() {
            $('#submit_form').submit();
        }

        function addNotes() {
            document.getElementById("div_notes").style.display = ""; 	   //show notes
            document.getElementById("buttonAddNotes").style.display = "none"; 	   //show notes
        }

        function removeNotes() {
            document.getElementById("div_notes").style.display = "none";  //hide notes
            document.getElementById("buttonAddNotes").style.display = "";  //hide notes
            $('#notes').val('');
        }

        function addAdditional() {
            document.getElementById("discount_percentage").style.display = "";
            document.getElementById("discount_value").style.display = "";
            document.getElementById("removeAdditional").style.display = "";
            document.getElementById("addAddtional").style.display = "none";
            document.getElementById("discount_lable").style.display = "";
        }

        function removeAdditional() {
            document.getElementById("discount_percentage").style.display = "none";
            document.getElementById("discount_value").style.display = "none";
            document.getElementById("removeAdditional").style.display = "none";
            document.getElementById("addAddtional").style.display = "";
            document.getElementById("discount_lable").style.display = "none";
        }

        function addAdditionalCharge(){
            $('#add_charge').append(`
                <tr>
                        <td colspan="2" style="width:60%"><p class="textright"><input class="form-control" name="additional_charge[`+add_index+`][name]"/></p></td>
                        <td colspan="2" style="width:40%"><p class="textright"><input class="form-control add_charge" name="additional_charge[`+add_index+`][value]"/></p></td>
                    </tr>
            `);    
            add_index++; 
        }

    </script>
@stop

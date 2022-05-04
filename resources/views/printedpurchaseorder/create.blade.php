@extends('adminlte::page')

@if($editPurchaseOrder)
    @section('title', 'Edit Printed Purchase Order')
@else
    @section('title', 'Create Printed Purchase Order')
@endif

<style type="text/css">
    .face{
        position: absolute;
        height: 0px;
        width: 0px;
        background-color: transparent;;
        border: 4px solid rgba(10,10,10,0.5);
    }
    .object-fit-container {
        overflow:hidden;
        border: 2px solid;
        padding: 10px;
    
    height: 230px; /*any size*/
    }

    .object-fit-cover {
    width: auto;
    height: 100%;
    display: block;
    margin-left: auto;
    margin-right: auto;
    object-fit: cover; /*magic*/
    }
    tr input {

        width:70px
    }
    /* .label_names
    {
        border:none !important;
        color:#000;
        font-weight:bold;
    } */
</style>

@section('content_header')
    <div class="row mb-0">
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @foreach (['danger', 'warning', 'success', 'info'] as $message)
                        @if(Session::has($message))
                            <div class="alert alert-{{ $message }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session($message) }}
                            </div>
                        @endif
                    @endforeach

                    <!-- /.card -->
                    <div class="card card-primary" >
                        <!-- card-header -->
                        <div class="card-header">
                            <h3 class="card-title">{{$editPurchaseOrder ? 'Edit' : 'Create'}} Printed Purchase Order</h3>
                            <div class="float-right">
                                @if($editPurchaseOrder)
                                    <a href="{{ route('printed.purchaseorder.show',$Po->id) }}" class="btn bg-gradient-primary mr-3">View</a>
                                @endif
                                <a href="{{ route('printed.purchaseorder.index') }}" class="btn bg-gradient-primary">Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ $editPurchaseOrder ? route('printed.purchaseorder.update', $Po->id) : route('printed.purchaseorder.store')  }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            @if($editPurchaseOrder) @method('PUT') @endif
                            <input type="hidden" name="type_store" value="{{$editPurchaseOrder ? $editPurchaseOrder->type : 'printed_po'}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap">
                                                <tr>
                                                    <th>Job No</th>
                                                    <td><input readonly name="job_no" value="{{ $Po ? old('job_no',$Po->id) : old('id') }}" class="form-control"></td>
                                                    <th>Customer</th>
                                                    <td>
                                                        <select class="form-control @error('customer_id') is-invalid @enderror" name="customer_id">
                                                            <option value="">Select Customer</option>
                                                            @foreach( $data['customerMaster'] as $customer)
                                                                @if($editPurchaseOrder)
                                                                    <option value="{{$customer['id']}}" {{ old('customer_id') == $customer['id'] ? 'selected' : ($customer['id'] == $editPurchaseOrder->customer_id ? 'selected' : '') }}>{{ucfirst($customer['company_name'])}} </option>
                                                                @else
                                                                    <option value="{{$customer['id']}}" {{ old('customer_id') == $customer['id'] ? 'selected' : '' }}>{{ucfirst($customer['company_name'])}} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('customer_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </td>
                                                    <th>Delivery Date</th>
                                                    <td><input type="date" name="date" value="{{ $editPurchaseOrder ? old('date',$editPurchaseOrder->date) : old('date') }}" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <th width="200px">Party PO No </th>
                                                    <td width="200px"><input type="text" name="party_po_no" value="{{ $Po && isset($Po->party_po_no) ? $Po->party_po_no : '' }}" class="form-control"></td>
                                                    <th width="200px">Sale Order No</th>
                                                    <td width="200px"><input type="text" name="sale_order_no" value="{{ $Po && isset($Po->sale_order_no) ? $Po->sale_order_no : '' }}" class="form-control"></td>
                                                    <th width="200px">Design No</th>
                                                    <td width="200px"><input type="text" name="our_design_no" value="{{ $Po && isset($Po->our_design_no) ? $Po->our_design_no : '' }}" class="form-control"></td>
                                                   
                                                </tr>

                                                <tr>
                                                    <th width="200px">Label </th>
                                                    <td width="200px"><input type="text" name="lable" value="{{ $Po && isset($Po->lable) ? $Po->lable : '' }}" class="form-control"></td>
                                                    <th width="200px">Material</th>
                                                    <td width="200px"><input type="text" name="meterial" value="{{ $Po && isset($Po->meterial) ? $Po->meterial : '' }}" class="form-control"></td>
                                                   
                                                </tr>

                                                <tr>
                                                    <th width="200px">Width mm </th>
                                                    <td width="200px"><input type="text" name="met_width" value="{{ $Po && isset($Po->met_width) ? $Po->met_width : '' }}" class="form-control"></td>
                                                    <th width="200px">Length mm</th>
                                                    <td width="200px"><input type="text" name="met_length" value="{{ $Po && isset($Po->met_length) ? $Po->met_length : '' }}" class="form-control"></td>
                                                </tr>

                                            </table>

                                            <table class="table table-bordered text-nowrap">
                                                <thead>
                                                 <tr>
                                                    <th> Size</th>
                                                    <td><input type="text" name=" qty_title[total_mail_lable]" value="{{ $Po && isset($Po-> qty_title->
                                                    total_mail_lable )? $Po->qty_title->total_mail_lable :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name=" qty_title[6_7_years]" value="{{ $Po && isset($Po-> qty_title->{'6_7_years'} )? $Po-> qty_title->{'6_7_years'} :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name=" qty_title[xs]" value="{{ $Po && isset($Po-> qty_title->xs )? $Po-> qty_title->xs :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name=" qty_title[s]" value="{{ $Po && isset($Po-> qty_title->s )? $Po-> qty_title->s :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name=" qty_title[m]" value="{{ $Po && isset($Po-> qty_title->m )? $Po-> qty_title->m :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name=" qty_title[l]" value="{{ $Po && isset($Po-> qty_title->l )? $Po-> qty_title->l :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name=" qty_title[xl]" value="{{ $Po && isset($Po-> qty_title->xl )? $Po-> qty_title->xl :'' }}" class="form-controls" ></td>
                                                    <td><input type="text" name=" qty_title[xxl]" value="{{ $Po && isset($Po-> qty_title->xxl )? $Po-> qty_title->xxl :'' }}" class="form-controls"></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                   <tr id="main_table_row">
                                                    <th>Qty manual</th>
                                                    <td><input type="text" name="qty[total_mail_lable]" value="{{ $Po && isset($Po->qty->
                                                    total_mail_lable ) ? $Po->qty->total_mail_lable :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name="qty[6_7_years]" value="{{ $Po && isset($Po->qty->{'6_7_years'} )? $Po->qty->{'6_7_years'} :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name="qty[xs]" value="{{ $Po && isset($Po->qty->xs )? $Po->qty->xs :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name="qty[s]" value="{{ $Po && isset($Po->qty->s )? $Po->qty->s :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name="qty[m]" value="{{ $Po && isset($Po->qty->m )? $Po->qty->m :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name="qty[l]" value="{{ $Po && isset($Po->qty->l )? $Po->qty->l :'' }}" class="form-controls main_txt_cal"></td>
                                                    <td><input type="text" name="qty[xl]" value="{{ $Po && isset($Po->qty->xl )? $Po->qty->xl :'' }}" class="form-controls" ></td>
                                                    <td><input type="text" name="qty[xxl]" value="{{ $Po && isset($Po->qty->xxl )? $Po->qty->xxl :'' }}" class="form-controls"></td>
                                                </tr>

                                               
                                                </tbody>
                                            </table>
                                                <table class="table table-bordered text-nowrap">
                                                <tbody>
                                                <tr id="main_table_row">
                                                    <th>Folding</th>
                                                    <td><input type="text" name="folding_basic" value="{{ $Po && isset($Po->folding_basic) ? $Po->folding_basic : '' }}" class="form-controls main_txt_cal"></td>
                                                </tr>

                                                <tr id="tab_table_row">
                                                    <th>Width mm</th>
                                                    <td><input type="text" name="width_basic" value="{{ $Po && isset($Po->width_basic) ? $Po->width_basic : '' }}" class="form-controls tab_txt_cal"></td>
                                                </tr>

                                                <tr id="size_table_row">
                                                    <th>Length mm</th>
                                                    <td><input type="text" name="length_basic" value="{{ $Po && isset($Po->length_basic) ? $Po->length_basic : '' }}" class="form-controls size_txt_cal"></td>
                                                </tr>

                                                <tr id="size_table_row">
                                                    <th>Total Mts need</th>
                                                    <td><input type="text" name="total_bts_basic" value="{{ $Po && isset($Po->total_bts_basic) ? $Po->total_bts_basic : '' }}" class="form-controls size_txt_cal"></td>
                                                    </tr>

                                                <tr id="size_table_row">
                                                    <th>Balance Stock</th>
                                                    <td><input type="text" name="balance" value="{{ $Po && isset($Po->balance) ? $Po->balance : '' }}" class="form-controls size_txt_cal"></td>
                                                    </tr>
                                          
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                           <div class="form-group">
                                               <div class="object-fit-container">   
                                                   @if($editPurchaseOrder)
                                                       @if($editPurchaseOrder->front_image)
                                                           <img class="object-fit-cover" src="{{asset('./designCards/'.$editPurchaseOrder->front_image)}}" id="result" />
                                                       @else
                                                           <img class="object-fit-cover" id="result" />
                                                       @endif
                                                   @else
                                                       <img class="object-fit-cover" id="result" />                                                  
                                                   @endif
                                               </div>
                                               <div class="mt-4">
                                                   <label for="file">Front Image</label>
                                                   <input type="hidden" name="front_image" id="front_crop_image">
                                                   <input type="file" id="file" name="front_crop_image" class="@error('front_crop_image') is-invalid @enderror" accept="image/*">
                                                   @error('front_crop_image') 
                                                       <div class="invalid-feedback">{{$message}}</div>
                                                   @enderror
                                               </div>
                                           </div> 
                                           <hr>
                                           <div class="form-group">
                                               <div class="object-fit-container">  
                                                   @if($editPurchaseOrder)
                                                       @if($editPurchaseOrder->back_image)
                                                           <img class="object-fit-cover" src="{{asset('./designCards/'.$editPurchaseOrder->back_image)}}" id="result1" />
                                                       @else
                                                           <img class="object-fit-cover" id="result1" />
                                                       @endif
                                                   @else
                                                       <img class="object-fit-cover" id="result1" />
                                                   @endif 
                                               </div>
                                               <div class="mt-4">
                                                   <label for="file">Back Image</label>
                                                   <input type="hidden" name="back_image" id="back_crop_image">
                                                   <input type="file" id="file1" class="@error('back_image') is-invalid @enderror" accept="image/*" name="back_crop_image">
                                                   @error('back_image') 
                                                       <div class="invalid-feedback">{{$message}}</div>
                                                   @enderror    
                                               </div>
                                           </div> 
                                           <hr>
                                           <div class="form-group">
                                               <div class="object-fit-container">   
                                                   @if($editPurchaseOrder)
                                                       @if($editPurchaseOrder->all_view_image)
                                                           <img class="object-fit-cover" src="{{asset('./designCards/'.$editPurchaseOrder->all_view_image)}}" id="result2" />
                                                       @else
                                                           <img class="object-fit-cover" id="result2" />
                                                       @endif
                                                   @else
                                                       <img class="object-fit-cover" id="result2" />
                                                   @endif 
                                               </div>
                                               <div class="mt-4">
                                                   <label for="file">All View Image</label>
                                                   <input type="hidden" name="all_view_image" id="all_view_crop_image">
                                                   <input type="file" id="file2" class="@error('all_view_crop_image') is-invalid @enderror" accept="image/*" name="all_view_crop_image"> 
                                                   @error('all_view_crop_image') 
                                                       <div class="invalid-feedback">{{$message}}</div>
                                                   @enderror                                              
                                               </div>
                                           </div> 
                                           <hr>
                                           <div class="form-group">
                                               <div class="mt-4">
                                                   <label for="document_name">Design File</label>
                                                   <input type="file" id="document_name" multiple name="design_files[]">
                                                   @php $errMsg = $errors->get('design_files.*'); @endphp
                                                   @if(isset($errMsg["design_files.0"][0]))
                                                       <div class="form-text" role="alert">
                                                           <small class="text-danger font-weight-bold">
                                                               {{ $errMsg["design_files.0"][0] }}
                                                           </small>
                                                       </div>
                                                   @endif
                                               </div>
                                           </div> 
                                       </div>
                                   </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">{{ $editPurchaseOrder ? 'Update' : 'Save'}}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pixelarity.css')}}">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function () {
            $("#main_table_row").on('input', '.main_txt_cal', function () {
                var calculated_total_sum = 0;
                
                $("#main_table_row .main_txt_cal").each(function () {
                    var get_textbox_value = $(this).val();
                    if ($.isNumeric(get_textbox_value)) {
                        calculated_total_sum += parseFloat(get_textbox_value);
                    }                  
                });
                $("#main_total_value").val(calculated_total_sum);
                console.log(calculated_total_sum);
            });

            $("#tab_table_row").on('input', '.tab_txt_cal', function () {
                var calculated_total_sum = 0;
                
                $("#tab_table_row .tab_txt_cal").each(function () {
                    var get_textbox_value = $(this).val();
                    if ($.isNumeric(get_textbox_value)) {
                        calculated_total_sum += parseFloat(get_textbox_value);
                    }                  
                });
                $("#tab_total_value").val(calculated_total_sum);
                console.log(calculated_total_sum);
            });

            $("#size_table_row").on('input', '.size_txt_cal', function () {
                var calculated_total_sum = 0;
                
                $("#size_table_row .size_txt_cal").each(function () {
                    var get_textbox_value = $(this).val();
                    if ($.isNumeric(get_textbox_value)) {
                        calculated_total_sum += parseFloat(get_textbox_value);
                    }                  
                });
                $("#size_total_value").val(calculated_total_sum);
                console.log(calculated_total_sum);
            });
        });
        
        // main row starts
        var index = 0;
        $("#addMainRow").click(function () {
            index++;
            let mainSequenceNo = $('.inputMainFormRow').length + 1;
            var html = `<tr class="inputMainFormRow">
                            <td><input type="text"  class="main_sequence" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" name="main_needle[${index}][needle_no]" value="${mainSequenceNo}" placeholder="Enter the value"></td>
                            <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" name="main_needle[${index}][pantone]" value="" placeholder="Enter the value"></td>
                            <td><input type="color" class="main_color" style="border-radius:.25rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="main_needle[${index}][color]" value="" placeholder="Enter the value"></td>
                            <td><input type="text" class="main_color_shade" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;"  name="main_needle[${index}][color_shade]" value=""></td>
                            <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;"  name="main_needle[${index}][denier]"  value="" placeholder="Enter the value"></td>
                         
                            <td>
                                <select name="main_needle[${index}][a]" class="main_yarn" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                    <option value="">Select Yarn</option>
                                    @foreach($data['yarnMaster'] as $yarn)
                                        <option value="{{ $yarn['id'] }}" data-main_color="{{ $yarn['yarn_color'] }}" data-main_shade="{{ $yarn['color_shade'] }}">{{ $yarn['shade_No'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <select name="main_needle[${index}][b]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                    <option value="">Select Yarn</option>
                                    @foreach($data['yarnMaster'] as $yarn)
                                        <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <select name="main_needle[${index}][c]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                    <option value="">Select Yarn</option>
                                    @foreach($data['yarnMaster'] as $yarn)
                                        <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <select name="main_needle[${index}][d]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                    <option value="">Select Yarn</option>
                                    @foreach($data['yarnMaster'] as $yarn)
                                        <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <select name="main_needle[${index}][e]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                    <option value="">Select Yarn</option>
                                    @foreach($data['yarnMaster'] as $yarn)
                                        <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td><button id="removeMainRow" class="btn btn-danger" type="button">remove</button></td>
                        </tr>`
            $('#add_main_new_row').append(html);
        });

        $(document).on('click', '#removeMainRow', function () {
            let tabl = $('.inputMainFormRow').length;
            if(tabl === 1)
            {
                alert("Sorry you can't remove this row");
            }
            else
            {
                $(this).closest('.inputMainFormRow').remove();
                $('.inputMainFormRow').each(function(i){
                    $(this).find('.main_sequence').val(i+1);
                });
            }
        });
        
        $(document).on("change",".main_yarn",function(){
            const mainColor = $(this).find(':selected').data('main_color');
            const mainShade = $(this).find(':selected').data('main_shade');
            $(this).closest('tr').find('.main_color').val(mainColor);
            $(this).closest('tr').find('.main_color_shade').val(mainShade);
        });
        // main row ends

        // tab row starts
        var tabIndex = 0;
        $("#addTabRow").click(function () {
            tabIndex++;
            let tabSequenceNo = $('.inputTabFormRow').length + 1;
            var tabHtml = `<tr class="inputTabFormRow">
                                <td><input type="text"  class="tab_sequence" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" name="tab_needle[${tabIndex}][needle_no]" value="${tabSequenceNo}" placeholder="Enter the value"></td>
                                <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" name="tab_needle[${tabIndex}][pantone]" value="" placeholder="Enter the value"></td>
                                <td><input type="color" class="tab_color" style="border-radius:.25rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="tab_needle[${tabIndex}][color]" value="" placeholder="Enter the value"></td>
                                <td><input type="text" class="tab_color_shade" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;"  name="tab_needle[${tabIndex}][color_shade]" value=""></td>
                                <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;"  name="tab_needle[${tabIndex}][denier]"  value="" placeholder="Enter the value"></td>

                                <td>
                                    <select name="tab_needle[${tabIndex}][a]" class="tab_yarn" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select A</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                            <option value="{{ $yarn['id'] }}" data-tab_color="{{ $yarn['yarn_color'] }}" data-tab_shade="{{ $yarn['color_shade'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="tab_needle[${tabIndex}][b]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select B</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                            <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="tab_needle[${tabIndex}][c]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select C</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                            <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="tab_needle[${tabIndex}][d]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select D</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                            <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="tab_needle[${tabIndex}][e]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select E</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                            <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td><button id="removeTabRow" class="btn btn-danger" type="button">remove</button></td>
                            </tr>`;
        
            $('#add_tab_new_row').append(tabHtml);
        });

        $(document).on('click', '#removeTabRow', function () {
            let tabl = $('.inputTabFormRow').length;
            if(tabl === 1)
            {
                alert("Sorry you can't remove this row");
            }
            else
            {
                $(this).closest('.inputTabFormRow').remove();
                $('.inputTabFormRow').each(function(i){
                    $(this).find('.tab_sequence').val(i+1);
                });
            }
        });

        $(document).on("change",".tab_yarn",function(){
            const tabColor = $(this).find(':selected').data('tab_color');
            const tabShade = $(this).find(':selected').data('tab_shade');
            $(this).closest('tr').find('.tab_color').val(tabColor);
            $(this).closest('tr').find('.tab_color_shade').val(tabShade);
        });
        // tab row ends

        // size row starts
        var sizeIndex = 0;
        $("#addSizeRow").click(function () {
            sizeIndex++;
            let sizeSequenceNo = $('.inputSizeFormRow').length + 1;
            var sizeHtml = `<tr class="inputTabFormRow">
                                <td><input type="text"  class="size_sequence" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" name="size_needle[${sizeIndex}][needle_no]" value="${sizeSequenceNo}" placeholder="Enter the value"></td>
                                <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" name="size_needle[${sizeIndex}][pantone]" value="" placeholder="Enter the value"></td>
                                <td><input type="color" class="size_color" style="border-radius:.25rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="size_needle[${sizeIndex}][color]" value="" placeholder="Enter the value"></td>
                                <td><input type="text" class="size_color_shade" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;"  name="size_needle[${sizeIndex}][color_shade]" value=""></td>
                                <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;"  name="size_needle[${sizeIndex}][denier]"  value="" placeholder="Enter the value"></td>

                                <td>
                                    <select name="size_needle[${sizeIndex}][a]" class="size_yarn" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select A</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                        <option value="{{ $yarn['id'] }}" data-size_color="{{ $yarn['yarn_color'] }}" data-size_shade="{{ $yarn['color_shade'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="size_needle[${sizeIndex}][b]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select B</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                            <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="size_needle[${sizeIndex}][c]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select C</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                            <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="size_needle[${sizeIndex}][d]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select D</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                            <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="size_needle[${sizeIndex}][e]" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;">
                                        <option value="">Select E</option>
                                        @foreach($data['yarnMaster'] as $yarn)
                                            <option value="{{ $yarn['id'] }}">{{ $yarn['shade_No'] }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td><button id="removeSizeRow" class="btn btn-danger" type="button">remove</button></td>
                            </tr>`;
            $('#add_size_new_row').append(sizeHtml);
        });

        $(document).on('click', '#removeSizeRow', function () {
            let tabl = $('.inputSizeFormRow').length;
            if(tabl === 1)
            {
                alert("Sorry you can't remove this row");
            }
            else
            {
                $(this).closest('.inputSizeFormRow').remove();
                $('.inputSizeFormRow').each(function(i){
                    $(this).find('.size_sequence').val(i+1);
                });
            }
        });

        $(document).on("change",".size_yarn",function(){
            const sizeColor = $(this).find(':selected').data('size_color');
            const sizeShade = $(this).find(':selected').data('size_shade');
            $(this).closest('tr').find('.size_color').val(sizeColor);
            $(this).closest('tr').find('.size_color_shade').val(sizeShade);
        });
        // size row ends     

        const airjet_16Speed   = "{{$data['loomrMaster'][0]['speed']}}";
        const airjet_12Speed   = "{{$data['loomrMaster'][1]['speed']}}";
        const mullerSpeed      = "{{$data['loomrMaster'][2]['speed']}}";

        $("#main_total_picks, #main_repeat_first_input").on("keyup",function(){
            const mainTotalPicks  = parseFloat($('#main_total_picks').val());        
            const mainLabFst      = $("#main_labelhrs_first");
            const mainLabsec      = $("#main_labelhrs_second");
            const mainLabThir     = $("#main_labelhrs_third");
            const mainRepFst      = $("#main_repeat_first_input");
            const mainRepSec      = $("#main_repeat_second_input");
            const mainRepThir     = $("#main_repeat_last_input");

            if(($("#main_total_picks").val() && !isNaN($("#main_total_picks").val())) && ($("#main_repeat_first_input").val() && !isNaN($("#main_repeat_first_input").val()))){
              const mainLabFirst  = (parseFloat(mullerSpeed)/mainTotalPicks)*parseFloat(mainRepFst.val())*60*0.85;
              const mainLabSecond = (parseFloat(airjet_12Speed)/mainTotalPicks)*(mainRepFst.val()*1.2)*60*0.85;
              const mainLabThird  = (parseFloat(airjet_16Speed)/mainTotalPicks)*(mainRepFst.val()*1.6)*60*0.85;
              mainLabFst.val(Math.floor(mainLabFirst));
              mainLabsec.val(Math.floor(mainLabSecond));
              mainLabThir.val(Math.floor(mainLabThird));
            
            }else{
                mainLabFst.val('');
                mainLabsec.val('');
                mainLabThir.val('');
            }
        });

        $("#main_repeat_first_input").on("keyup",function(){
            const mainRepFirst   = $(this).val()
            const mainRepSecond  = $("#main_repeat_second_input");
            const mainRepThird   = $("#main_repeat_last_input");
               
            if(mainRepFirst && !isNaN(mainRepFirst)){
                const mainFirstCal = parseFloat(mainRepFirst) * 1.2;
                const mainLastCal  = parseFloat(mainRepFirst) * 1.6;

                mainRepSecond.val(Math.floor(mainFirstCal));
                mainRepThird.val(Math.floor(mainLastCal));
            }
            else{
                mainRepSecond.val('');
                mainRepThird.val('');
            }
        });

        $("#tab_total_picks, #tab_repeat_first_input").on("keyup",function(){
            const tabTotalPicks  = parseFloat($("#tab_total_picks").val());        
            const tabLabFst      = $("#tab_labelhrs_first");
            const tabLabsec      = $("#tab_labelhrs_second");
            const tabLabThir     = $("#tab_labelhrs_third");
            const tabRepFst      = $("#tab_repeat_first_input");
            const tabRepSec      = $("#tab_repeat_second_input");
            const tabRepThir     = $("#tab_repeat_last_input");

            if(($("#tab_total_picks").val() != "" && !isNaN($("#tab_total_picks").val())) && ($("#tab_repeat_first_input").val() !="" && !isNaN($("#tab_repeat_first_input").val()))){
              const tabLabFirst  = (parseFloat(mullerSpeed)/tabTotalPicks)*parseFloat(tabRepFst.val())*60*0.85;
              const tabLabSecond = (parseFloat(airjet_12Speed)/tabTotalPicks)*(tabRepFst.val() * 1.2)*60*0.85;
              const tabLabThird  = (parseFloat(airjet_16Speed)/tabTotalPicks)*(tabRepFst.val() * 1.6)*60*0.85;
              tabLabFst.val(Math.floor(tabLabFirst));
              tabLabsec.val(Math.floor(tabLabSecond));
              tabLabThir.val(Math.floor(tabLabThird));
            
            }else{
                tabLabFst.val('');
                tabLabsec.val('');
                tabLabThir.val('');
            }
        });

        $("#tab_repeat_first_input").on("keyup",function(){
            const tabRepFirst      = $(this).val();
            const tabRepSecond     = $("#tab_repeat_second_input");
            const tabRepThird      = $("#tab_repeat_last_input");
            
            if(tabRepFirst && !isNaN(tabRepFirst)){
                const tabFirstCal     = parseFloat(tabRepFirst) * 1.2;
                const tabLastCal      = parseFloat(tabRepFirst) * 1.6;

                tabRepSecond.val(Math.floor(tabFirstCal));
                tabRepThird.val(Math.floor(tabLastCal));
            }else{
                tabRepSecond.val("");
                tabRepThird.val("");
            }
        });

        $("#size_total_picks, #size_repeat_first_input").on("keyup",function(){
            const sizeTotalPicks  = parseFloat($("#size_total_picks").val());        
            const sizeLabFst      = $("#size_labelhrs_first");
            const sizeLabsec      = $("#size_labelhrs_second");
            const sizeLabThir     = $("#size_labelhrs_third");
            const sizeRepFst      = $("#size_repeat_first_input");
            const sizeRepSec      = $("#size_repeat_second_input");
            const sizeRepThir     = $("#size_repeat_last_input");

            if(($("#size_total_picks").val() && !isNaN($("#size_total_picks").val())) && ($("#size_repeat_first_input").val() && !isNaN($("#size_repeat_first_input").val()))){
              const sizeLabFirst  = (parseFloat(mullerSpeed)/sizeTotalPicks)*parseFloat(sizeRepFst.val())*60*0.85;
              const sizeLabSecond = (parseFloat(airjet_12Speed)/sizeTotalPicks)*(sizeRepFst.val()*1.2)*60*0.85;
              const sizeLabThird  = (parseFloat(airjet_16Speed)/sizeTotalPicks)*(sizeRepFst.val()*1.6)*60*0.85;
              sizeLabFst.val(Math.floor(sizeLabFirst));
              sizeLabsec.val(Math.floor(sizeLabSecond));
              sizeLabThir.val(Math.floor(sizeLabThird));
            
            }else{
                sizeLabFst.val('');
                sizeLabsec.val('');
                sizeLabThir.val('');
            }
        });

        $("#size_repeat_first_input").on("keyup",function(){
            const sizeRepFirst    = $(this).val();
            const sizeRepSecond   = $("#size_repeat_second_input");
            const sizeRepThird    = $("#size_repeat_last_input");

            if(sizeRepFirst && !isNaN(sizeRepFirst)){
                const sizeFirstCal = parseFloat(sizeRepFirst) * 1.2;
                const sizeLastCal  = parseFloat(sizeRepFirst) * 1.6;
                sizeRepSecond.val(Math.floor(sizeFirstCal));
                sizeRepThird.val(Math.floor(sizeLastCal));
            }else{
                sizeRepSecond.val("");
                sizeRepThird.val("");
            }
        });

        $("#main_width_input, #main_length_input").on("keyup",function(){
            let main_width = parseFloat($("#main_width_input").val());
            let main_length = parseFloat($("#main_length_input").val());
            let main_sq_mm = main_width * main_length;
            let main_sq_inch = main_sq_mm * 0.03937;
            if (!isNaN(main_sq_mm)) {
                $("#main_sq_mm_input").val(main_sq_mm);
                $("#main_sq_inch_input").val(main_sq_inch.toFixed(3));
            }
            else {
                $("#main_sq_mm_input").val("");
                $("#main_sq_inch_input").val("");
            }
        });

        $("#tab_width_input, #tab_length_input").on("keyup",function(){
            console.log("typing");
            let tab_width = parseFloat($("#tab_width_input").val());
            let tab_length = parseFloat($("#tab_length_input").val());
            let tab_sq_mm = tab_width * tab_length;
            let tab_sq_inch = tab_sq_mm * 0.03937;
            if (!isNaN(tab_sq_mm)) {
                $("#tab_sq_mm_input").val(tab_sq_mm);
                $("#tab_sq_inch_input").val(tab_sq_inch.toFixed(3));
            }
            else {
                $("#tab_sq_mm_input").val("");
                $("#tab_sq_inch_input").val("");
            }
        });

        $("#size_width_input, #size_length_input").on("keyup",function(){
            let size_width = parseFloat($("#size_width_input").val());
            let size_length = parseFloat($("#size_length_input").val());
            let size_sq_mm = size_width * size_length;
            let size_sq_inch = size_sq_mm * 0.03937;
            if (!isNaN(size_sq_mm)) {
                $("#size_sq_mm_input").val(size_sq_mm);
                $("#size_sq_inch_input").val(size_sq_inch.toFixed(3));
            }
            else {
                $("#size_sq_mm_input").val("");
                $("#size_sq_inch_input").val("");
            }
        });

        $("#tab_label").on("change",function(){
            var tablabel_val = $(this).val() == 'no' ? 'yes' : 'no';
            $("#tab_label").val(tablabel_val);
            $(".tab_label_input").toggleClass("d-none");
        });

        $("#size_label").on("change",function(){
            var tablabel_val = $(this).val() == 'no' ? 'yes' : 'no';
            $("#size_label").val(tablabel_val);
            $(".size_label_input").toggleClass("d-none");
        });
    </script>
@stop

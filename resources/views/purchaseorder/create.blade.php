@extends('adminlte::page')

@if($editPurchaseOrder)
    @section('title', 'Edit Purchase Order')
@else
    @section('title', 'Create Purchase Order')
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
                            <h3 class="card-title">{{$editPurchaseOrder ? 'Edit' : 'Create'}} Purchase Order</h3>
                            <div class="float-right">
                                @if($editPurchaseOrder)
                                    <a href="{{ route('purchaseorder.show',$Po->id) }}" class="btn bg-gradient-primary mr-3">View</a>
                                @endif
                                <a href="{{ route('purchaseorder.index') }}" class="btn bg-gradient-primary">Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ $editPurchaseOrder ? route('purchaseorder.update', $Po->id) : route('woven.store')  }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            @if($editPurchaseOrder) @method('PUT') @endif
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap">
                                                <tr>
                                                    <th>Job No</th>
                                                    <td><input readonly name="job_no" value="{{ $Po ? old('job_no',$Po->id) : old('id') }}" class="form-control"></td>
                                                    <th>Date</th>
                                                    <td><input type="date" name="date" value="{{ $editPurchaseOrder ? old('date',$editPurchaseOrder->date) : old('date') }}" class="form-control"></td>
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
                                                </tr>
                                                <tr>
                                                    <th>Customer Grade</th>
                                                    <td>
                                                        <select name="category" class="form-control">
                                                            <option value="">Select Category</option>
                                                            @foreach( $data['categoryMaster'] as $category)
                                                                @if($editPurchaseOrder)
                                                                    <option value="{{$category['id']}}" {{ old('category') == $category['id'] ? 'selected' : ($category['id'] == $editPurchaseOrder->category ? 'selected' : '') }}>{{ucfirst($category['category_name'])}} </option>
                                                                @else
                                                                    <option value="{{$category['id']}}" {{ old('category') == $category['id'] ? 'selected' : '' }}>{{ucfirst($category['category_name'])}} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <th>Label</th>
                                                    <td>
                                                        @if($editPurchaseOrder)
                                                        <input type="text" name="label" value="{{ $editPurchaseOrder ? old('label',$editPurchaseOrder->label) : old('label') }}" class="form-control">
                                                         @else
                                                             <select  class="form-control" id="designcard_change" name="label">
                                                            <option value="">Select Label</option>
                                                            @foreach( $DesignCard as $design)
                                                                
                                                                    <option  value="{{$design['id']}}" >{{ucfirst($design['label'])}} </option>
                                                               
                                                            @endforeach
                                                        </select>     
                                                       
                                                        @endif
                                                        
                                                        </td>
                                                    <th>Delivery Date</th>
                                                    <td><input type="date" name="date" value="{{ $editPurchaseOrder ? old('date',$editPurchaseOrder->date) : old('date') }}" class="form-control"></td>
                                                </tr>

                                                <tr>
                                                    <th width="200px">Design No</th>
                                                    <td width="200px"><input type="text" name="main_label[design_no]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['design_no']) ? $editPurchaseOrder->main_label['design_no'] : '' }}" class="form-control"></td>
                                                    <th>Designer</th>
                                                    <td>
                                                        <select class="form-control" name="designer_id">
                                                            <option value="">Select Designer</option>
                                                            @foreach( $data['designerMaster'] as $designer) 
                                                                @if($editPurchaseOrder)
                                                                    <option value="{{$designer['id']}}" {{ old('designer_id') == $designer['id'] ? 'selected' : ($designer['id'] == $editPurchaseOrder->designer_id ? 'selected' : '') }}>{{ucfirst($designer['name'])}} </option>
                                                                @else
                                                                    <option value="{{$designer['id']}}" {{ old('designer_id') == $designer['id'] ? 'selected' : '' }}>{{ucfirst($designer['name'])}} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <th>Sales Rep</th>
                                                    <td>
                                                        <select class="form-control" name="salesrep_id">
                                                            <option value="">Select Sales Rep</option>
                                                            @foreach( $data['salesrepMaster'] as $salesrep) 
                                                                @if($editPurchaseOrder)
                                                                    <option value="{{$salesrep['id']}}" {{ old('salesrep_id') == $salesrep['id'] ? 'selected' : ($salesrep['id'] == $editPurchaseOrder->salesrep_id ? 'selected' : '') }}>{{ucfirst($salesrep['name'])}} </option>
                                                                    @else
                                                                    <option value="{{$salesrep['id']}}" {{ old('salesrep_id') == $salesrep['id'] ? 'selected' : '' }}>{{ucfirst($salesrep['name'])}} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Sample Weaver</th>
                                                    <td width="150px">
                                                        <div class="form-group row mx-2">
                                                            <select style="width: 50%;"  class="form-control" name="weaver[]">
                                                                <option value="">Select</option>
                                                                @foreach( $data['loomOperator'] as $loom)
                                                                    @if($editPurchaseOrder)
                                                                        <option value="{{$loom['id']}}" {{ old('weaver.0') == $loom['id'] ? 'selected' : ($loom['id'] == (isset($editPurchaseOrder->weaver[0]) ? $editPurchaseOrder->weaver[0] : '')? 'selected' : '') }}>{{ucfirst($loom['name'])}} </option>
                                                                    @else
                                                                        <option value="{{$loom['id']}}" {{ old('weaver.0') == $loom['id'] ? 'selected' : '' }}>{{ucfirst($loom['name'])}} </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <select style="width: 50%;" class="form-control" name="weaver[]">
                                                                <option value="">Select</option>
                                                                @foreach( $data['loomOperator'] as $loom)
                                                                    @if($editPurchaseOrder)
                                                                        <option value="{{$loom['id']}}" {{ old('weaver.1') == $loom['id'] ? 'selected' : ($loom['id'] == (isset($editPurchaseOrder->weaver[1]) ? $editPurchaseOrder->weaver[1] : '')? 'selected' : '') }}>{{ucfirst($loom['name'])}} </option>
                                                                    @else
                                                                        <option value="{{$loom['id']}}" {{ old('weaver.1') == $loom['id'] ? 'selected' : '' }}>{{ucfirst($loom['name'])}} </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <th>Warp</th>
                                                    <td>
                                                        <select name="warps_id" class="form-control">
                                                            <option value="">Select Warp</option>
                                                            @foreach( $data['warpMaster'] as $warp) 
                                                                @if($editPurchaseOrder)
                                                                    <option value="{{$warp['id']}}" {{ old('warps_id') == $warp['id'] ? 'selected' : ($warp['id'] == $editPurchaseOrder->warps_id ? 'selected' : '') }}>{{ucfirst($warp['name'])}} </option>
                                                                @else
                                                                    <option value="{{$warp['id']}}" {{ old('warps_id') == $warp['id'] ? 'selected' : '' }}>{{ucfirst($warp['name'])}} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
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
                                                 
                                            <div class="row">
                                                <div class="col">
                                                    <table class="table table-bordered text-nowrap">
                                                        <tr>
                                                            <th></th>
                                                            <th>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" id="main_label" checked disabled>
                                                                    <label class="custom-control-label" for="main_label">Main Label</label>
                                                                </div>
                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <th width="200px">Design No</th>
                                                            <td width="200px"><input type="text" name="main_label[design_no]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['design_no']) ? $editPurchaseOrder->main_label['design_no'] : '' }}" class="form-control"></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th width="200px">Picks/Cm</th>
                                                            <td width="200px"><input type="text" name="main_label[picks]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['picks']) ? $editPurchaseOrder->main_label['picks'] : '' }}" class="form-control"></td>
                                                        </tr>

                                                        <tr>
                                                            <th width="200px">Total Picks</th>
                                                            <td width="200px"><input type="text" name="main_label[total_picks]" id="main_total_picks" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['total_picks']) ? $editPurchaseOrder->main_label['total_picks'] : '' }}" class="form-control"></td>
                                                        </tr>

                                                        <tr>
                                                            <th width="200px">Repeats</th>
                                                            <td width="200px">
                                                                <div class="form-group row">
                                                                    @if($editPurchaseOrder)
                                                                        <input type="text" name="main_label[total_repeat][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['total_repeat'][0]) ? old('main_label.total_repeat.0',$editPurchaseOrder->main_label['total_repeat'][0]) : old('main_label.total_repeat.0') }}" class="form-control col" id="main_repeat_first_input">
                                                                        <input type="text" name="main_label[total_repeat][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['total_repeat'][1]) ? old('main_label.total_repeat.1',$editPurchaseOrder->main_label['total_repeat'][1]) : old('main_label.total_repeat.1') }}" class="form-control col" id="main_repeat_second_input">
                                                                        <input type="text" name="main_label[total_repeat][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['total_repeat'][2]) ? old('main_label.total_repeat.2',$editPurchaseOrder->main_label['total_repeat'][2]) : old('main_label.total_repeat.2') }}" class="form-control col" id="main_repeat_last_input">
                                                                    @else
                                                                        <input type="text" name="main_label[total_repeat][]" value="{{ old('main_label.total_repeat.0') }}" id="main_repeat_first_input" class="form-control col">
                                                                        <input type="text" name="main_label[total_repeat][]" value="{{ old('main_label.total_repeat.1') }}" id="main_repeat_second_input" class="form-control col">
                                                                        <input type="text" name="main_label[total_repeat][]" value="{{ old('main_label.total_repeat.2') }}" id="main_repeat_last_input" class="form-control col">
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="200px">Time Need To Weave Hrs</th>
                                                            <td width="200px">
                                                                <div class="form-group row">
                                                                    @if($editPurchaseOrder)
                                                                        <input type="text" id="main_labelhrs_first" name="main_label[total_labour_hours][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['total_labour_hours'][0]) ? old('main_label.total_labour_hours.0', $editPurchaseOrder->main_label['total_labour_hours'][0]) : old('main_label.total_labour_hours.0') }}" class="form-control col">
                                                                        <input type="text" id="main_labelhrs_second" name="main_label[total_labour_hours][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['total_labour_hours'][1]) ? old('main_label.total_labour_hours.1', $editPurchaseOrder->main_label['total_labour_hours'][1]) : old('main_label.total_labour_hours.1') }}" class="form-control col">
                                                                        <input type="text" id="main_labelhrs_third" name="main_label[total_labour_hours][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['total_labour_hours'][2]) ? old('main_label.total_labour_hours.2', $editPurchaseOrder->main_label['total_labour_hours'][2]) : old('main_label.total_labour_hours.2') }}" class="form-control col">
                                                                    @else
                                                                        <input type="text" id="main_labelhrs_first" name="main_label[total_labour_hours][]" value="{{ old('main_label.total_labour_hours.0') }}" class="form-control col">
                                                                        <input type="text" id="main_labelhrs_second" name="main_label[total_labour_hours][]" value="{{ old('main_label.total_labour_hours.1') }}" class="form-control col">
                                                                        <input type="text" id="main_labelhrs_third" name="main_label[total_labour_hours][]" value="{{ old('main_label.total_labour_hours.2') }}" class="form-control col">
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th width="200px">Wastage</th>
                                                            <td width="200px">
                                                                <div class="form-group d-flex">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" value="yes" name="main_label[wastage]" {{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['wastage']) ? $editPurchaseOrder->main_label['wastage'] == 'yes' ? 'checked' : '' : '' }}>
                                                                        <label class="form-check-label ml-4">Yes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" value="no" name="main_label[wastage]" {{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['wastage']) ? $editPurchaseOrder->main_label['wastage'] == 'no' ? 'checked' : '' : 'checked' }}>
                                                                        <label class="form-check-label ml-4">No</label>
                                                                    </div>
                                                                </div>                                                                
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th width="200px">Finishings</th>
                                                            <td width="200px"><input type="text" id="main_width_input" name="main_label[width]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['width']) ? $editPurchaseOrder->main_label['width'] : '' }}" class="form-control"></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="200px">Width mm</th>
                                                            <td width="200px"><input type="text" id="main_width_input" name="main_label[width]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['width']) ? $editPurchaseOrder->main_label['width'] : '' }}" class="form-control"></td>
                                                        </tr>

                                                        <tr>
                                                            <th width="200px">Length mm</th>
                                                            <td width="200px"><input type="text" id="main_length_input" name="main_label[length]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['length']) ? $editPurchaseOrder->main_label['length'] : '' }}" class="form-control"></td>
                                                        </tr>

                                                        <tr>
                                                            <th width="200px">Total Area Sq mm</th>
                                                            <td width="200px"><input type="text" id="main_sq_mm_input" name="main_label[sq_mm]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['sq_mm']) ? $editPurchaseOrder->main_label['sq_mm'] : '' }}" class="form-control"></td>
                                                        </tr>

                                                        <tr>
                                                            <th width="200px">Sq inch</th>
                                                            <td width="200px"><input type="text" id="main_sq_inch_input" name="main_label[sq_inch]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['sq_inch']) ? $editPurchaseOrder->main_label['sq_inch'] : '' }}" class="form-control"></td>
                                                        </tr>
                                                        <tr>
                                                            <th width="200px">Cost /sq inch</th>
                                                            <td width="200px"><input type="text" id="main_sq_inch_input" name="main_label[sq_inch]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->main_label['sq_inch']) ? $editPurchaseOrder->main_label['sq_inch'] : '' }}" class="form-control"></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="col">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>
                                                                <div class="custom-control custom-checkbox">
                                                                    @if($editPurchaseOrder)
                                                                        <input type="checkbox" name="tab_label[label]"  value="{{ (isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'yes') ? 'yes' : 'no') : 'no') }}" {{ (isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'yes') ? 'checked' : '') : '') }} class="custom-control-input" id="tab_label">
                                                                    @else
                                                                        <input type="checkbox" name="tab_label[label]"  value="{{ old('tab_label.label') == 'yes' ? 'yes' : 'no' }}" {{ old('tab_label.label') == 'yes' ? 'checked' : '' }} class="custom-control-input" id="tab_label">
                                                                    @endif
                                                                    <label class="custom-control-label" for="tab_label">Tab Label</label>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="tab_label[design_no]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['design_no']) ? old('tab_label.design_no',$editPurchaseOrder->tab_label['design_no']) : old('tab_label.design_no') }}" class="form-control"></td>
                                                        </tr>
                                                        
                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                          <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="tab_label[picks]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['picks']) ? old('tab_label.picks', $editPurchaseOrder->tab_label['picks']) : old('tab_label.picks') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" id="tab_total_picks" name="tab_label[total_picks]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['total_picks']) ? old('tab_label.total_picks', $editPurchaseOrder->tab_label['total_picks']) : old('tab_label.total_picks') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px">
                                                                <div class="form-group row">
                                                                    @if($editPurchaseOrder)
                                                                        <input type="text" id="tab_repeat_first_input" name="tab_label[total_repeat][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['total_repeat'][0]) ? old('tab_label.total_repeat.0',$editPurchaseOrder->tab_label['total_repeat'][0]) : ''  }}" class="form-control col">
                                                                        <input type="text" id="tab_repeat_second_input" name="tab_label[total_repeat][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['total_repeat'][1]) ? old('tab_label.total_repeat.1',$editPurchaseOrder->tab_label['total_repeat'][1]) : ''  }}" class="form-control col">
                                                                        <input type="text" id="tab_repeat_last_input" name="tab_label[total_repeat][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['total_repeat'][2]) ? old('tab_label.total_repeat.2',$editPurchaseOrder->tab_label['total_repeat'][2]) : ''  }}" class="form-control col">
                                                                    @else
                                                                        <input type="text" id="tab_repeat_first_input" name="tab_label[total_repeat][]" value="{{ old('tab_label.total_repeat.0') }}" class="form-control col">
                                                                        <input type="text" id="tab_repeat_second_input" name="tab_label[total_repeat][]" value="{{ old('tab_label.total_repeat.1') }}" class="form-control col">
                                                                        <input type="text" id="tab_repeat_last_input" name="tab_label[total_repeat][]" value="{{ old('tab_label.total_repeat.2') }}" class="form-control col">
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px">
                                                                <div class="form-group row">
                                                                    @if($editPurchaseOrder)
                                                                        <input type="text" id="tab_labelhrs_first" name="tab_label[total_labour_hours][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['total_labour_hours'][0]) ? old('tab_label.total_labour_hours.0', $editPurchaseOrder->tab_label['total_labour_hours'][0]) : old('tab_label.total_labour_hours.0') }}" class="form-control col">
                                                                        <input type="text" id="tab_labelhrs_second" name="tab_label[total_labour_hours][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['total_labour_hours'][1]) ? old('tab_label.total_labour_hours.1', $editPurchaseOrder->tab_label['total_labour_hours'][1]) : old('tab_label.total_labour_hours.1') }}" class="form-control col">
                                                                        <input type="text" id="tab_labelhrs_third" name="tab_label[total_labour_hours][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['total_labour_hours'][2]) ? old('tab_label.total_labour_hours.2', $editPurchaseOrder->tab_label['total_labour_hours'][2]) : old('tab_label.total_labour_hours.2') }}" class="form-control col">
                                                                    @else
                                                                        <input type="text" id="tab_labelhrs_first" name="tab_label[total_labour_hours][]" value="{{ old('tab_label.total_labour_hours.0') }}" class="form-control col">
                                                                        <input type="text" id="tab_labelhrs_second" name="tab_label[total_labour_hours][]" value="{{ old('tab_label.total_labour_hours.1') }}" class="form-control col">
                                                                        <input type="text" id="tab_labelhrs_third" name="tab_label[total_labour_hours][]" value="{{ old('tab_label.total_labour_hours.2') }}" class="form-control col">
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px">
                                                                <div class="form-group d-flex">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" value="yes" name="tab_label[wastage]" {{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['wastage']) ? $editPurchaseOrder->tab_label['wastage'] == 'yes' ? 'checked' : '' : '' }}>
                                                                        <label class="form-check-label ml-4">Yes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" value="no" name="tab_label[wastage]" {{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['wastage']) ? $editPurchaseOrder->tab_label['wastage'] == 'no' ? 'checked' : '' : 'checked' }}>
                                                                        <label class="form-check-label ml-4">No</label>
                                                                    </div>
                                                                </div>  
                                                            </td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                             <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                             <td width="200px"><input type="text" name="tab_label[finishings]" id="tab_finishings_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['finishings']) ? old('tab_label.finishings', $editPurchaseOrder->tab_label['finishings']) : old('tab_label.finishings') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px">
                                                                <input type="text" name="tab_label[width]" id="tab_width_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['width']) ? old('tab_label.width', $editPurchaseOrder->tab_label['width']) :  old('tab_label.width') }}" class="form-control">
                                                            </td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="tab_label[length]" id="tab_length_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['length']) ? old('tab_label.length', $editPurchaseOrder->tab_label['length']) : old('tab_label.length') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="tab_label[sq_mm]" id="tab_sq_mm_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['sq_mm']) ? old('tab_label.sq_mm', $editPurchaseOrder->tab_label['sq_mm']) : old('tab_label.sq_mm') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="tab_label[sq_inch]" id="tab_sq_inch_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['sq_inch']) ? old('tab_label.sq_inch', $editPurchaseOrder->tab_label['sq_inch']) : old('tab_label.sq_inch') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="tab_label_input {{ isset($editPurchaseOrder->tab_label['label']) ? (($editPurchaseOrder->tab_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="tab_label_input @if(old('tab_label.label') == 'no') d-none @elseif(old('tab_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="tab_label[cost_sq_inch]" id="tab_cost_sq_inch_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->tab_label['cost_sq_inch']) ? old('size_label.cost_sq_inch', $editPurchaseOrder->tab_label['cost_sq_inch']) : old('size_label.cost_sq_inch') }}" class="form-control"></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="col">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>
                                                                <div class="custom-control custom-checkbox">
                                                                    @if($editPurchaseOrder)
                                                                        <input type="checkbox" name="size_label[label]"  value="{{ (isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'yes') ? 'yes' : 'no') : 'no') }}" {{ (isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'yes') ? 'checked' : '') : '') }} class="custom-control-input" id="size_label">
                                                                    @else
                                                                        <input type="checkbox" name="size_label[label]"  value="{{ old('size_label.label') == 'yes' ? 'yes' : 'no' }}" {{ old('size_label.label') == 'yes' ? 'checked' : '' }} class="custom-control-input" id="size_label">
                                                                    @endif
                                                                    <label class="custom-control-label" for="size_label">Size Label</label>
                                                                </div>
                                                            </th>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="size_label[design_no]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['design_no']) ? old('size_label.design_no',$editPurchaseOrder->size_label['design_no']) : old('size_label.design_no') }}" class="form-control"></td>
                                                        </tr>
                                                        
                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="size_label[picks]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['picks']) ? old('size_label.picks',$editPurchaseOrder->size_label['picks']) : old('size_label.picks') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" id="size_total_picks" name="size_label[total_picks]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['total_picks']) ? old('size_label.total_picks',$editPurchaseOrder->size_label['total_picks']) : old('size_label.total_picks') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px">
                                                                <div class="form-group row">
                                                                    @if($editPurchaseOrder)
                                                                        <input type="text" id="size_repeat_first_input" name="size_label[total_repeat][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['total_repeat'][0]) ? old('size_label.total_repeat.0',$editPurchaseOrder->size_label['total_repeat'][0]) : old('size_label.total_repeat.0') }}" class="form-control col">
                                                                        <input type="text" id="size_repeat_second_input" name="size_label[total_repeat][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['total_repeat'][1]) ? old('size_label.total_repeat.1',$editPurchaseOrder->size_label['total_repeat'][1]) : old('size_label.total_repeat.1') }}" class="form-control col">
                                                                        <input type="text" id="size_repeat_last_input" name="size_label[total_repeat][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['total_repeat'][2]) ? old('size_label.total_repeat.2',$editPurchaseOrder->size_label['total_repeat'][2]) : old('size_label.total_repeat.2') }}" class="form-control col">
                                                                    @else
                                                                        <input type="text" id="size_repeat_first_input" name="size_label[total_repeat][]" value="{{ old('size_label.total_repeat.0') }}" class="form-control col">
                                                                        <input type="text" id="size_repeat_second_input" name="size_label[total_repeat][]" value="{{ old('size_label.total_repeat.1') }}" class="form-control col">
                                                                        <input type="text" id="size_repeat_last_input" name="size_label[total_repeat][]" value="{{ old('size_label.total_repeat.2') }}" class="form-control col">
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px">
                                                                <div class="form-group row">
                                                                    @if($editPurchaseOrder)
                                                                        <input type="text" id="size_labelhrs_first" name="size_label[total_labour_hours][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['total_labour_hours'][0]) ? old('size_label.total_labour_hours.0',$editPurchaseOrder->size_label['total_labour_hours'][0]) : old('size_label.total_labour_hours.0') }}" class="form-control col">
                                                                        <input type="text" id="size_labelhrs_second" name="size_label[total_labour_hours][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['total_labour_hours'][1]) ? old('size_label.total_labour_hours.1',$editPurchaseOrder->size_label['total_labour_hours'][1]) : old('size_label.total_labour_hours.1') }}" class="form-control col">
                                                                        <input type="text" id="size_labelhrs_third" name="size_label[total_labour_hours][]" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['total_labour_hours'][2]) ? old('size_label.total_labour_hours.2',$editPurchaseOrder->size_label['total_labour_hours'][2]) : old('size_label.total_labour_hours.2') }}" class="form-control col">
                                                                    @else
                                                                        <input type="text" id="size_labelhrs_first" name="size_label[total_labour_hours][]" value="{{ old('size_label.total_labour_hours.0') }}" class="form-control col">
                                                                        <input type="text" id="size_labelhrs_second" name="size_label[total_labour_hours][]" value="{{ old('size_label.total_labour_hours.1') }}" class="form-control col">
                                                                        <input type="text" id="size_labelhrs_third" name="size_label[total_labour_hours][]" value="{{ old('size_label.total_labour_hours.2') }}" class="form-control col">
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px">
                                                                <div class="form-group d-flex">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" value="yes" name="size_label[wastage]" {{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['wastage']) ? $editPurchaseOrder->size_label['wastage'] == 'yes' ? 'checked' : '' : '' }}>
                                                                        <label class="form-check-label ml-4">Yes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" value="no" name="size_label[wastage]" {{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['wastage']) ? $editPurchaseOrder->size_label['wastage'] == 'no' ? 'checked' : '' : 'checked' }}>
                                                                        <label class="form-check-label ml-4">No</label>
                                                                    </div>
                                                                </div>                                                                
                                                            </td>
                                                        </tr>
                                                        @if($editPurchaseOrder)
                                                           <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                             <td width="200px"><input type="text" name="size_label[finishings]" id="size_finishings_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['finishings']) ? old('size_label.finishings', $editPurchaseOrder->size_label['finishings']) : old('size_label.finishings') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="size_label[width]" id="size_width_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['width']) ? old('size_label.width', $editPurchaseOrder->size_label['width']) : old('size_label.width') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="size_label[length]" id="size_length_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['length']) ? old('size_label.length', $editPurchaseOrder->size_label['length']) : old('size_label.length') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="size_label[sq_mm]" id="size_sq_mm_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['sq_mm']) ? old('size_label.sq_mm', $editPurchaseOrder->size_label['sq_mm']) : old('size_label.sq_mm') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                            <td width="200px"><input type="text" name="size_label[sq_inch]" id="size_sq_inch_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['sq_inch']) ? old('size_label.sq_inch', $editPurchaseOrder->size_label['sq_inch']) : old('size_label.sq_inch') }}" class="form-control"></td>
                                                        </tr>

                                                        @if($editPurchaseOrder)
                                                            <tr class="size_label_input {{ isset($editPurchaseOrder->size_label['label']) ? (($editPurchaseOrder->size_label['label'] == 'no') ? 'd-none' : '') : 'd-none' }}">
                                                        @else
                                                            <tr class="size_label_input @if(old('size_label.label') == 'no') d-none @elseif(old('size_label.label') == 'yes')) @else d-none @endif">
                                                        @endif
                                                             <td width="200px"><input type="text" name="size_label[cost_sq_inch]" id="size_cost_sq_inch_input" value="{{ $editPurchaseOrder && isset($editPurchaseOrder->size_label['cost_sq_inch']) ? old('size_label.cost_sq_inch', $editPurchaseOrder->size_label['cost_sq_inch']) : old('size_label.cost_sq_inch') }}" class="form-control"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>


                                            
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
                            <td><input type="text" readonly class="main_sequence" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" name="main_needle[${index}][needle_no]" value="${mainSequenceNo}" placeholder="Enter the value"></td>
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
                                <td><input type="text" readonly class="tab_sequence" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" name="tab_needle[${tabIndex}][needle_no]" value="${tabSequenceNo}" placeholder="Enter the value"></td>
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
                                <td><input type="text" readonly class="size_sequence" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" name="size_needle[${sizeIndex}][needle_no]" value="${sizeSequenceNo}" placeholder="Enter the value"></td>
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
        
                                                            $('#designcard_change').on('change',function(){
                                                                window.location.href = '{{ url('/purchase-order/createpo') }}/' + this.options[this.selectedIndex].value;
                                                            })
    </script>
@stop

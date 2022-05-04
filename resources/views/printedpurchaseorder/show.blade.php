@extends('adminlte::page')

@section('title', 'View Design Card')
<style> 
    .table_wrp input {
        width: 100%;
        border: 0;
        outline: none;
    }
    input.input_hlf {
        width: 40px;
        padding: 0;
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
    tr.main_label_input {
    height: 45px!important;
}
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
                    <div class="card card-primary" id="print_area">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('View Printed Purchase Order - ')}} <span class="font-weight-bold">{{ucfirst($viewDesignCard->label)}}</span></h3>
                            <div class="float-right">
                                <button type="button" class="btn bg-gradient-success mr-3" id="print">Print</button>
                                <a href="{{ route('printed.purchaseorder.edit',$Po->id) }}" class="btn bg-gradient-primary mr-3">Edit</a>
                                <a href="{{ route('printed.purchaseorder.index') }}" class="btn bg-gradient-danger">Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap">
                                            <tr>
                                                <th>Customer</th>
                                                <td colspan="2" >{{ $viewDesignCard->customerDetail ? ucwords($viewDesignCard->customerDetail->company_name ) : '-' }}</td>
                                                <!--<th>Label</th>-->
                                                <!--<td>{{ ucwords($viewDesignCard->label ) }}</td>-->
                                                <th>Date</th>
                                                <td colspan="2" >{{ $viewDesignCard->date }}</td>
                                            </tr>

                                            <tr>
                                                    <th>Party PO No </th>
                                                    <td>
                                                      {{ $Po->party_po_no}} 
                                                    </td>
                                                    <th>Sale Order No </th>
                                                    <td>
                                                       {{ $Po->sale_order_no }}
                                                    </td>
                                                    <th>Our Design  No </th>
                                                    <td width="">
                                                       {{ $Po->our_design_no }}
                                                    </td>
                                                </tr>
    
                                                 <tr>
                                                    <th>Lable </th>
                                                    <td>
                                                      {{ $Po->lable }}
                                                    </td>
                                                    <th>Meterial </th>
                                                    <td>
                                                       {{ $Po->meterial }}
                                                    </td>
                                                    <td> <lable>Width mm : </lable> {{ $Po->met_width }}</td>
                                                    <td>
                                                       <lable>Length mm : </lable> {{ $Po->our_design_no }}
                                                    </td>
                                                </tr>
                                                 
                                                <tr>
                                                    <th>Size Label</th>
                                                    <th>{{ $Po && isset($Po-> qty_title->
                                                    total_mail_lable ) ? $Po-> qty_title->total_mail_lable :'' }}</th>
                                                    <th>{{ $Po && isset($Po-> qty_title->{'6_7_years'} )? $Po-> qty_title->{'6_7_years'} :'' }}</th>
                                                    <th>{{ $Po && isset($Po-> qty_title->xs )? $Po-> qty_title->xs :'' }}</th>
                                                    <th>{{ $Po && isset($Po-> qty_title->s )? $Po-> qty_title->s :'' }}</th>
                                                    <th>{{ $Po && isset($Po-> qty_title->m )? $Po-> qty_title->m :'' }}</th>
                                                    <th>{{ $Po && isset($Po-> qty_title->l )? $Po-> qty_title->l :'' }}</th>
                                                    <th>{{ $Po && isset($Po-> qty_title->xl )? $Po-> qty_title->xl :'' }}</th>
                                                    <th>{{ $Po && isset($Po-> qty_title->xxl )? $Po-> qty_title->xxl :'' }}</th>
                                                </tr>
                                                   <tr id="main_table_row">
                                                    <th>Qty manual</th>
                                                    <td>{{ $Po && isset($Po->qty->
                                                    total_mail_lable ) ? $Po->qty->total_mail_lable :'' }}</td>
                                                    <td>{{ $Po && isset($Po->qty->{'6_7_years'} )? $Po->qty->{'6_7_years'} :'' }}</td>
                                                    <td>{{ $Po && isset($Po->qty->xs )? $Po->qty->xs :'' }}</td>
                                                    <td>{{ $Po && isset($Po->qty->s )? $Po->qty->s :'' }}</td>
                                                    <td>{{ $Po && isset($Po->qty->m )? $Po->qty->m :'' }}</td>
                                                    <td>{{ $Po && isset($Po->qty->l )? $Po->qty->l :'' }}</td>
                                                    <td>{{ $Po && isset($Po->qty->xl )? $Po->qty->xl :'' }}</td>
                                                    <td>{{ $Po && isset($Po->qty->xxl )? $Po->qty->xxl :'' }}</td>
                                                </tr>

                                               
                                                
                                                <tr>
                                                    <th>Folding  </th>
                                                    <td>
                                                      {{ $Po->folding }}
                                                    </td>
                                                    <td> <lable>Width mm : </lable> {{ $Po->our_design_no }} </td>
                                                    <td>
                                                       <lable>Length mm : </lable> {{ $Po->fold_width }}
                                                    </td>
                                                    <td >
                                                       <lable>Total Mts need</lable> {{ $Po->fold_lenth }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th  >Total Mts need</th>
                                                    <td  >
                                                      {{ $Po->total }}
                                                    </td>
                                                    
                                                
                                                    <th  >Balance Stock</th>
                                                    <td >
                                                      {{ $Po->balance }}
                                                    </td>
                                                    
                                                </tr>
                                        </table>
                                                
                                       
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Front Image</label>
                                        <div class="object-fit-container"> 
                                           @if($viewDesignCard->front_image) 
                                            <img class="object-fit-cover"  src="{{asset('./designCards/'.$viewDesignCard->front_image)}}"/>
                                            @endif
                                        </div>
                                    </div> 
                                    <hr>
                                    <div class="form-group">
                                        <label>Back Image</label>
                                        <div class="object-fit-container">
                                            @if($viewDesignCard->back_image)   
                                            <img class="object-fit-cover"  src="{{asset('./designCards/'.$viewDesignCard->back_image)}}"/>
                                            @endif
                                        </div>
                                    </div> 
                                    <hr>
                                    <div class="form-group">
                                        <label>All View Image</label>
                                        <div class="object-fit-container">
                                             @if($viewDesignCard->all_view_image)   
                                            <img class="object-fit-cover" src="{{asset('./designCards/'.$viewDesignCard->all_view_image)}}" />
                                            @endif
                                        </div>
                                    </div> 
                                    <hr>
                                    <div class="form-group">
                                        <div class="mt-4">
                                            <label for="document_name">Design File</label>
                                            @if($viewDesignCard->design_file && count(json_decode($viewDesignCard->design_file)) > 0)
                                                @foreach(json_decode($viewDesignCard->design_file) as $designFile)
                                                <p class="mt-1">
                                                    <a href="{{asset('./cardsDocuments/'.$viewDesignCard->id.'/'.$designFile)}}" class="text-success" download><i class="fas fa-download mr-2"></i> {{ $designFile }}</a>
                                                </p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $("#print").on('click', function () {
            // $("#print_area").show();
            window.print();
        })
    </script>
@stop

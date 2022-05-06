@extends('adminlte::page')

@section('title', 'mou')

@section('content_header')
    <div class="row mb-1">
        <div class="offset-md-1 col-md-10">
            <h1 class="font-weight-bold float-left">
                {{ __('mou - ') . ucwords($mou->name)}}
            </h1>

        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="offset-md-1 col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">MOU Details</h3>
                            <div class="float-right">
                               
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table class="table table-bordered table-sm action-hide">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                               
                                    <tr>
                                        <td>{{ $mou->mou_code }}</td>
                                        <td>{{ $mou->mouDetails->full_name }}</td>
                                        <td>{{ $mou->from_date }}</td>
                                        <td>{{$mou->to_date}}</td>
                                        <td></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="offset-md-1 col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Customer Order by Monthly</h3>
                            <div class="float-right">
                            <button onclick="clculate_incentive('{{$mou->id}}',0)" class="btn bg-gradient-success mr-2">{{ __('Calculate') }}</button>
                            <button onclick="clculate_incentive('{{$mou->id}}',1)" class="btn bg-gradient-warning mr-2">{{ __('Submit') }}</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table class="table table-bordered table-sm action-hide">
                            <thead>
                            <tr>
                                <th>Month</th>
                                <th>Customer Order</th>
                                <th>Unserviced ZDOP Quantity</th>
                                <th>Invoice Domestic Lifting</th>
                                <th>Invoice Deemed Export Lifting</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                               
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                            <select class="form-control" id="month" name="month">
                                            <option value="">Select Month </option>
                                            <option value="jul">July </option>
                                            <option value="aug">August </option>
                                            <option value="sep">September </option>
                                            <option value="oct">October </option>
                                            <option value="nov">November </option>
                                            <option value="dec">December </option>
                                            <option value="jan">January </option>
                                            <option value="feb">February </option>
                                            <option value="mar">March </option>
                                            </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                            <input type="text" class="form-control" id="customer_order" name="customer_order">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                            <input type="text" class="form-control" id="unserviced_quantity" name="unserviced_quantity">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                            <input type="text" class="form-control" id="domestic_lifting" name="domestic_lifting">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                            <input type="text" class="form-control" id="export_lifting" name="export_lifting">
                                            </div>
                                        </td>
                                        <td></td>
                                        
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="offset-md-1 col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Customer Incentives</h3>
                            <div class="float-right">
                            
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table class="table table-bordered table-sm action-hide">
                            <thead>
                            <tr>
                                <th>Incentive Period</th>
                                <th>MOU</th>
                                <th>Customer Order</th>
                                <th>Unserviced ZDOP Quantity</th>
                                <th>Invoice Domestic Lifting</th>
                                <th>Invoice Deemed Export Lifting</th>
                                <th>Achievement %</th>
                                <th>Total Qty to be considered for CCS Eligibility</th>
                                <th>Total Qty to be considered for CCS Calculation</th>
                                <th>Rate</th>
                                <th>Incentive</th>
                                <th>Deviation Count</th>
                                <th>Comments</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="incentive_details">
                               @if($incentives)
                               @if($incentives->jul)
                               <tr>
                                @foreach ( json_decode($incentives->jul)  as $jul)
                                <td>{{ $jul}}</td>  
                                @endforeach
                                <td></td>
                                </tr> 
                                @endif 
                                @if($incentives->aug) 
                                <tr>
                                @foreach ( json_decode($incentives->aug)  as $aug)
                                <td>{{ $aug}}</td>  
                                @endforeach
                                <td></td>
                                </tr> 
                                @endif
                                @if($incentives->sep)
                                <tr>
                                @foreach ( json_decode($incentives->sep)  as $sep)
                                <td>{{ $sep}}</td>  
                                @endforeach
                                <td></td>
                                </tr> 
                                @endif
                                @if($incentives->q2)
                                <tr>
                                @foreach ( json_decode($incentives->q2)  as $q2)
                                <td>{{ $q2}}</td>  
                                @endforeach
                                <td></td>
                                </tr> 
                                @endif
                                @if($incentives->oct)
                                <tr>
                                @foreach ( json_decode($incentives->oct)  as $oct)
                                <td>{{ $oct}}</td>  
                                @endforeach
                                <td></td>
                                </tr>
                                @endif
                                @if($incentives->nov) 
                                <tr>
                                @foreach ( json_decode($incentives->nov)  as $nov)
                                <td>{{ $nov}}</td>  
                                @endforeach
                                <td></td>
                                </tr> 
                                @endif
                                @if($incentives->dec) 
                                <tr>
                                @foreach ( json_decode($incentives->dec)  as $dec)
                                <td>{{ $dec}}</td>  
                                @endforeach
                                <td></td>
                                </tr> 
                                @endif
                                @if($incentives->q3)
                                <tr>
                                @foreach ( json_decode($incentives->q3)  as $q3)
                                <td>{{ $q3}}</td>  
                                @endforeach
                                <td></td>
                                </tr> 
                                @endif
                                @if($incentives->jan)
                                <tr>
                                @foreach ( json_decode($incentives->jan)  as $jan)
                                <td>{{ $jan}}</td>  
                                @endforeach
                                <td></td>
                                </tr>
                                @endif
                                @if($incentives->feb) 
                                <tr>
                                @foreach ( json_decode($incentives->feb)  as $feb)
                                <td>{{ $feb}}</td>  
                                @endforeach
                                <td></td>
                                </tr>
                                @endif
                                @if($incentives->mar) 
                                <tr>
                                @foreach ( json_decode($incentives->mar)  as $mar)
                                <td>{{ $mar}}</td>  
                                @endforeach
                                <td></td>
                                </tr>
                                @endif
                                @if($incentives->annual) 
                                <tr>
                                @foreach ( json_decode($incentives->annual)  as $annual)
                                <td>{{ $annual}}</td>  
                                @endforeach
                                <td></td>
                                </tr>
                                @endif
                                @endif
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <script>
function clculate_incentive(mou_id,status){
 var period_month = $("#month").val();
 var customer_order = $("#customer_order").val();
 var unserviced_quantity = $("#unserviced_quantity").val();
 var domestic_lifting = $("#domestic_lifting").val();
 var export_lifting = $("#export_lifting").val();
  if(period_month==""){
    alert("Select Month");
    return false;
  }
  if(customer_order==""){
    alert("Enter customer order");
    return false;
  }
  if(unserviced_quantity==""){
    alert("Enter Unserviced ZDOP Quantity");
    return false;
  }
  if(domestic_lifting==""){
    alert("Enter Invoice Domestic Lifting");
    return false;
  }
  if(export_lifting==""){
    alert("Enter Invoice Deemed Export Lifting");
    return false;
  }
  $("#incentive_details").html();
  $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url('calculate') }}",
        data : {'mou_id':mou_id,'status':status,'period_month' : period_month,'customer_order':customer_order,'unserviced_quantity':unserviced_quantity,'domestic_lifting':domestic_lifting,'export_lifting':export_lifting},
        type : 'POST',
        dataType : 'json',

        success : function(result){
            if(status==1){
                setTimeout(function(){
                    location.reload();
					}, 2000); 
            }else{
                $("#incentive_details").html(result.html);
            }
            
        }
    });


}
    </script>
@stop

@extends('adminlte::page')

@section('title', 'Edit Woven')

<style type="text/css">
    .face{
        position: absolute;
        height: 0px;
        width: 0px;
        background-color: transparent;;
        border: 4px solid rgba(10,10,10,0.5);
    }
    .object-fit-container {
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
                            <h3 class="card-title">Edit Design Card</h3>
                            <div class="float-right">
                                <a href="{{ route('woven.edit',$woven->id) }}" class="btn bg-gradient-primary mr-3">Edit</a>
                                <a href="{{ route('woven.index') }}" class="btn bg-gradient-danger">Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('woven.update', $woven->id) }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-body row"  style=" overflow: scroll;margin: 15px;" >
                                <div class="table_forms">
                                    <div class="table_wrp table-responsive">
                                        <table style="width: 1000px; margin: auto;" class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:0;">
                                                        <table width="100%">
                                                            <tr>
                                                                <td width="150px"><strong>Customer</strong></td>
                                                                <td width=300px>
                                                                    <select class="form-control col-6 @error('customer_id') is-invalid @enderror" id="customer" name="customer_id">
                                                                        <option value="">Please Select Customer</option>
                                                                        @foreach( $data['customerMaster'] as $customer) 
                                                                            <option value="{{$customer['id']}}" {{ old('customer_id') == $customer['id'] ? 'selected' : ($customer['id'] == $editdesignCard->customer_id ? 'selected' : '') }}>{{ucfirst($customer['full_name'])}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('customer_id')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                                <td width="150px" ><strong>Date</strong></td>
                                                                    <td width="150px" >
                                                                    <input type="date" class="form-control col-6 @error('date') is-invalid @enderror" id="date" name="date" value="{{ $editdesignCard->date}}" placeholder="">
                                                                    @error('date')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td width="150px"><strong>Label </strong></td>
                                                                <td width=300px>
                                                                    <input type="text" class="form-control col-6 @error('lable') is-invalid @enderror" id="label" name="lable" value="{{$editdesignCard->lable}}" placeholder="label">
                                                                    @error('lable')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                                <td colspan="2"></td>
                                                            </tr>
                                                        </table>
                                                        <!-- design details  -->
                                                        <table width="100%">
                                                            <tr>
                                                                <td width="150px"><strong>Designer</strong></td>
                                                                <td>
                                                                    <select class="form-control col-4 @error('designer_id') is-invalid @enderror" id="designer" name="designer_id">
                                                                        <option value="">Please Select Designer</option>
                                                                        @foreach( $data['designerMaster'] as $designer) 
                                                                            <option value="{{$designer['id']}}" {{ old('designer_id') == $designer['id'] ? 'selected' : ($designer['id'] == $editdesignCard->designer_id ? 'selected' : '') }}>{{ucfirst($designer['name'])}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('designer_id')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                                <td><strong>Design No</strong></td>
                                                                <td>
                                                                    <input type="text" class="form-control col-9 @error('design_number') is-invalid @enderror" id="design_no" name="design_number" value="{{old('design_number', $editdesignCard->design_number)}}" placeholder="DH546">
                                                                    @error('design_number')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="150px"><strong>Sales Rep</strong></td>
                                                                <td>
                                                                    <select class="form-control col-4 @error('salesrep_id') is-invalid @enderror" id="sales_rep" name="salesrep_id">
                                                                        <option value="">Please Select Sales Rep</option>
                                                                        @foreach( $data['salesrepMaster'] as $salesrep) 
                                                                            <option value="{{$salesrep['id']}}" {{ old('salesrep_id') == $salesrep['id'] ? 'selected' : ($salesrep['id'] == $editdesignCard->salesrep_id ? 'selected' : '') }}>{{ucfirst($salesrep['name'])}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('salesrep_id')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                                <td><strong>Quality</strong></td>
                                                                <td><input type="text" class="form-control col-9" placeholder="Enter the value" value=""></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="150px"><strong>Sample Weaver</strong></td>
                                                                <td>
                                                                    <select class="form-control col-4 @error('weaver_id') is-invalid @enderror" id="sample_weaver" name="weaver[]" multiple>
                                                                        <option value="">Please Sample</option>
                                                                        @foreach( $data['designerMaster'] as $designer) 
                                                                            <option value="{{$designer['id']}}" {{ in_array($designer['id'], $editdesignCard->weaver_id) ? 'selected' : '' }}>{{$designer['name']}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('weaver')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                                <td width="150px"><strong>Warp</strong></td>
                                                                <td>
                                                                    <select class="form-control col-9 @error('warp') is-invalid @enderror" id="warp" name="warps_id">
                                                                        <option value="">Please Select Warp</option>
                                                                        @foreach( $data['warpMaster'] as $warp) 
                                                                            <option value="{{$warp['id']}}" {{ old('warps_id') == $warp['id'] ? 'selected' : ($warp['id'] == $editdesignCard->warps_id ? 'selected' : '') }}>{{ucfirst($warp['name'])}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('warps_id')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Picks/cm</strong></td>
                                                                <td>
                                                                    <div class="d-flex"> 
                                                                        <input type="text" class="form-control col-4 @error('pick') is-invalid @enderror" id="pick" name="picks" value="{{old('picks',$editdesignCard->picks)}}" placeholder="Pick"> <span>/cm</span>
                                                                        @error('picks')
                                                                            <span class="error invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </td>
                                                                <td><strong>Total Pick</strong></td>
                                                                <td>
                                                                    <input type="text" name="total_picks" class="form-control col-9 @error('total_picks') is-invalid @enderror" value="{{old('total_picks',$editdesignCard->total_picks)}}" placeholder="Enter the value"> 
                                                                    @error('total_picks')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <!-- design details  -->
                                                        <table width="100%">
                                                            <tr>
                                                                <th>Looms</th>
                                                                @foreach($data['loomMaster'] as $looms)
                                                                    <th>{{ucfirst($looms['loom_name'])}}</th>
                                                                    <input type="hidden" value="{{$looms['loom_name']}}" name="looms[]">
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <th>Total Repeats</th>
                                                                @foreach($editdesignCard->total_repet as $total_repet)
                                                                    <td><input type="text" class="form-control col-7" name="total_repet[]" value="{{ $total_repet }}" placeholder="Enter the value"></td>
                                                                @endforeach
                                                            </tr>
                                                        </table>
                                                        <table width="100%">
                                                            <tr>
                                                                <td width="150px"><strong>Wastage</strong></td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" value="yes" name="wastage" {{ old('wastage') == "yes" ? 'checked' : ($editdesignCard->wastage == "yes" ? 'checked' : '') }}>
                                                                        <label class="form-check-label">YES</label>
                                                                        <input class="form-check-input" type="radio" value="no" name="wastage" {{ old('wastage') == "no" ? 'checked' : ($editdesignCard->wastage == "no" ? 'checked' : '') }} style="margin-left:35px;">
                                                                        <label class="form-check-label" style="margin-left:55px;">NO</label>
                                                                    </div>
                                                                    @error('wastage')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                                <td><strong>Finishings</strong></td>
                                                                <td>
                                                                    <select class="form-control col-6 @error('finishing_id') is-invalid @enderror" name="finishing_id">
                                                                        <option value="">Please Select Warp</option>
                                                                        @foreach( $data['finishingMaster'] as $finishing) 
                                                                            <option value="{{$finishing['id']}}" {{ old('finishing_id') == $finishing['id'] ? 'selected' : ($finishing['id'] == $editdesignCard->finishing_id ? 'selected' : '') }}>{{ucfirst($finishing['machine'])}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('finishing_id')
                                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="150px">
                                                                    <strong>Width mm</strong>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <input type="text" class="form-control col-6 @error('width') is-invalid @enderror" name="width" value="{{ old('width',$editdesignCard->width) }}" placeholder="Enter the value">
                                                                        @error('finishing_id')
                                                                            <span class="error invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <strong>Length mm</strong>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <input type="text" class="form-control col-6 @error('length') is-invalid @enderror" name="length" value="{{ old('length',$editdesignCard->length) }}" placeholder="Enter the value">
                                                                        @error('length')
                                                                            <span class="error invalid-feedback">{{ $message }}</span>
                                                                        @enderror 
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="150px">
                                                                    <strong>Total Area /Sq mm</strong>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <input type="text" class="form-control col-6 @error('total_cost') is-invalid @enderror" name="total_cost" value="{{ old('total_cost',$editdesignCard->total_cost) }}" placeholder="Enter the value">
                                                                        @error('total_cost')
                                                                            <span class="error invalid-feedback">{{ $message }}</span>
                                                                        @enderror 
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <strong>cost in roll</strong>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <input type="text" class="form-control col-6 @error('cost_in_roll') is-invalid @enderror" name="cost_in_roll" value="{{ old('cost_in_roll',$editdesignCard->cost_in_roll) }}" placeholder="Enter the value">
                                                                        @error('cost_in_roll')
                                                                            <span class="error invalid-feedback">{{ $message }}</span>
                                                                        @enderror 
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="150px">
                                                                    <strong>Sq Inch </strong>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <input type="text" class="form-control col-6 @error('sq_inch') is-invalid @enderror" name="sq_inch" value="{{ old('sq_inch',$editdesignCard->sq_inch) }}" placeholder="Enter the value">
                                                                        @error('sq_inch')
                                                                            <span class="error invalid-feedback">{{ $message }}</span>
                                                                        @enderror 
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <strong>Cost /sq inch</strong>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <input type="text" class="form-control col-6 @error('total_cost') is-invalid @enderror" placeholder="Enter the value">
                                                                        @error('total_cost')
                                                                            <span class="error invalid-feedback">{{ $message }}</span>
                                                                        @enderror 
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>

                                                    <td style="padding:0;" width="300px">
                                                        <div class="form-group ">
                                                            <div class="object-fit-container">   
                                                                <img class="object-fit-cover"  id="result" />
                                                            </div>
                                                            <label for="file">Design Image</label>
                                                            <input type="file" class=" @error('crap_image') is-invalid @enderror" id="file" name="crap_image" value="{{ old('crap_image') }}">
                                                            @error('crap_image')
                                                                <span class="error invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div> 
                                                        <div><img width="100%" src="./img.jpg" alt=""></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0;" colspan="2">
                                                        <table width="100%">
                                                            <tr>
                                                                <th>Add ons</th>
                                                                <th>Basic</th>
                                                                <th>Cut fold</th>
                                                                <th>Diecut</th>
                                                                <th>Nonwoven</th>
                                                                <th>Iron on back</th>
                                                                <th>Extras</th>
                                                                <th>TOTAL</th>
                                                                <th>Offered </th>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:300px;">Cost</th>
                                                                <td><input type="text" class="form-control" name="add_on_cast[]" value="{{ isset($editdesignCard->add_on_cast['0']) ?  $editdesignCard->add_on_cast['0'] : '' }}" placeholder="Enter the value"></td>
                                                                <td><input type="text" class="form-control" name="add_on_cast[]" value="{{ isset($editdesignCard->add_on_cast['1']) ?  $editdesignCard->add_on_cast['1'] : '' }}" placeholder="Enter the value"></td>
                                                                <td><input type="text" class="form-control" name="add_on_cast[]" value="{{ isset($editdesignCard->add_on_cast['2']) ?  $editdesignCard->add_on_cast['2'] : '' }}" placeholder="Enter the value"></td>
                                                                <td><input type="text" class="form-control" name="add_on_cast[]" value="{{ isset($editdesignCard->add_on_cast['3']) ?  $editdesignCard->add_on_cast['3'] : '' }}" placeholder="Enter the value"></td>
                                                                <td><input type="text" class="form-control" name="add_on_cast[]" value="{{ isset($editdesignCard->add_on_cast['4']) ?  $editdesignCard->add_on_cast['4'] : '' }}" placeholder="Enter the value"></td>
                                                                <td><input type="text" class="form-control" name="add_on_cast[]" value="{{ isset($editdesignCard->add_on_cast['5']) ?  $editdesignCard->add_on_cast['5'] : '' }}" placeholder="Enter the value"></td>
                                                                <td><input type="text" class="form-control" name="add_on_cast[]" value="{{ isset($editdesignCard->add_on_cast['6']) ?  $editdesignCard->add_on_cast['6'] : '' }}" placeholder="Enter the value"></td>
                                                                <td><input type="text" class="form-control" name="add_on_cast[]" value="{{ isset($editdesignCard->add_on_cast['7']) ?  $editdesignCard->add_on_cast['7'] : '' }}" placeholder="Enter the value"></td>
                                                           
                                                            </tr>
                                                        </table>
                                                        <!-- needle table  -->
                                                        <table width="100%">
                                                            <tr>
                                                                <th>Needle No/Pantone</th>
                                                                <th>Color</th>
                                                                <th>Color Shade</th>
                                                                <th>Denier</th>
                                                                <th>A</th>
                                                                <th>B</th>
                                                                <th>C</th>
                                                                <th>D</th>
                                                                <th>E</th>
                                                            </tr>
                                                            @forelse($editdesignCard->needle as $needle)
                                                                <tr>
                                                                    <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="needle[needle_no_pantone]" value="{{ $needle['needle_no_pantone'] }}" placeholder="Enter the value"></td>
                                                                    <td><input type="color" style="border-radius:.25rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="needle[color]" value="{{ $needle['color'] }}" placeholder="Enter the value"></td>
                                                                    <td><input type="color" style="border-radius:.25rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="needle[color_shade]" value="{{ $needle['color_shade'] }}"></td>
                                                                    <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="needle[denier]"  value="{{ $needle['denier'] }}" placeholder="Enter the value"></td>
                                                                    <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="needle[a]" value="{{ $needle['a'] }}" placeholder="Enter the value"></td>
                                                                    <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="needle[b]" value="{{ $needle['b'] }}" placeholder="Enter the value"></td>
                                                                    <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="needle[c]" value="{{ $needle['c'] }}" placeholder="Enter the value"></td>
                                                                    <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="needle[d]" value="{{ $needle['d'] }}" placeholder="Enter the value"></td>
                                                                    <td><input type="text" style="border-radius:.25rem; padding:.375rem .75rem; color: #495057; background-color: #fff;  border: 1px solid #ced4da;" class="form-controls" name="needle[e]" value="{{ $needle['e'] }}" placeholder="Enter the value"></td>
                                                                </tr>
                                                            @empty
                                                                <tr colspan="9">
                                                                    <td>No Needle pantone found...</td>
                                                                </tr>
                                                            @endforelse
                                                        </table>
                                                        <!-- needle table  -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop

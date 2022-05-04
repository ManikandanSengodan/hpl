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
    <div class="row mb-2">

    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary" id="print_area">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('View Design Card - ')}} <span class="font-weight-bold">{{ucfirst($viewDesignCard->label)}}</span></h3>
                            <div class="float-right">
                                <button type="button" class="btn bg-gradient-success mr-3" id="print">Print</button>
                                <a href="{{ route('woven.edit',$viewDesignCard->id) }}" class="btn bg-gradient-primary mr-3">Edit</a>
                                  <a href="{{ route('purchaseorder.createpo',$viewDesignCard->id) }}" class="btn bg-gradient-success mr-3">Make PO</a>
                                
                                <a href="{{ route('woven.index') }}" class="btn bg-gradient-danger">Back</a>
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
                                                <td>{{ $viewDesignCard->customerDetail ? ucwords($viewDesignCard->customerDetail->company_name ) : '-' }}</td>
                                                <th>Label</th>
                                                <td>{{ ucwords($viewDesignCard->label ) }}</td>
                                                <th>Date</th>
                                                <td>{{ $viewDesignCard->date }}</td>
                                            </tr>

                                            <tr>
                                                <th>Designer</th>
                                                <td>{{ $viewDesignCard->designerDetail? ucwords($viewDesignCard->designerDetail->name ) : '-' }}</td>
                                                <th>Sales Rep</th>
                                                <td>{{ ($viewDesignCard->salesRepDetail)?ucwords($viewDesignCard->salesRepDetail->name ) :'-'}}</td>
                                                <th>Weaver</th>
                                                <td width="150px">
                                                    @foreach($weavers as $w)
                                                     {{$w['name']}}
                                                    @endforeach
                                                   
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Warp</th>
                                                <td>{{ $viewDesignCard->warpDetail ? ucwords($viewDesignCard->warpDetail->name) : '-' }}</td>
                                                <th>Folds</th>
                                                <td>{{ $viewDesignCard->foldMasterDetail ? ucwords($viewDesignCard->foldMasterDetail->type_of_fold ) : '-' }}</td>
                                                <th>Notes</th>
                                                <td>{{ $viewDesignCard->description }}</td>
                                            </tr>

                                            <tr>
                                                <th>Category</th>
                                                <td>
                                                    {{ $viewDesignCard->categoryMasterDetail ? ucwords($viewDesignCard->categoryMasterDetail->category_name) : "-" }}
                                                </td>
                                                <td colspan="5"></td>
                                            </tr>
                                        </table>
                                                
                                        <div class="row">
                                            <div class="col">
                                                <table class="table table-bordered text-nowrap">
                                                    <tr>
                                                        <th></th>
                                                        <th>Main Label</th>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <th width="200px">Design No</th>
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->main_label['design_no']) ? $viewDesignCard->main_label['design_no'] : '-' }}</td>
                                                    </tr>
                                                    
                                                    <tr class="main_label_input">
                                                        <th width="200px">Quality
                                                      </th>
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->main_label['quality']) ? \App\Models\WovenQuality::find($viewDesignCard->main_label['quality'])->quality : '-' }}</td>
                                                    </tr>
                                                    
                                                    <tr class="main_label_input">
                                                        <th width="200px">Picks/Cm</th>
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->main_label['picks']) ? $viewDesignCard->main_label['picks'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <th width="200px">Total Picks</th>
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->main_label['total_picks']) ? $viewDesignCard->main_label['total_picks'] : '-' }}</td>
                                                    </tr>
                                                    
                                                    <tr class="main_label_input">
                                                        <th width="200px">Total Repeat</th>
                                                        <td width="200px">
                                                            @if(isset($viewDesignCard->main_label['total_repeat']))
                                                                @foreach($viewDesignCard->main_label['total_repeat'] as $total_repeat)
                                                                   @if(!empty($total_repeat) || $total_repeat != null || $total_repeat != "")
                                                                        {{ $loop->first ? '' : ', ' }}
                                                                        {{ $total_repeat }}
                                                                    @else
                                                                        
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <th width="200px">Total Lable/Hours</th>
                                                        <td width="200px">
                                                            @if(isset($viewDesignCard->main_label['total_labour_hours']))
                                                                @foreach($viewDesignCard->main_label['total_labour_hours'] as $total_labour_hours)
                                                                   @if(!empty($total_labour_hours) || $total_labour_hours != null || $total_labour_hours != "")
                                                                        {{ $loop->first ? '' : ', ' }}
                                                                        {{ $total_labour_hours }}
                                                                    @else
                                                                        
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <th width="200px">Wastage</th>
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->main_label['wastage']) ? $viewDesignCard->main_label['wastage'] : '' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <th width="200px">Width</th>
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->main_label['width']) ? $viewDesignCard->main_label['width'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <th width="200px">Length</th>
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->main_label['length']) ? $viewDesignCard->main_label['length'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <th width="200px">Sq mm</th>
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->main_label['sq_mm']) ? $viewDesignCard->main_label['sq_mm'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <th width="200px">Sq inch</th>
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->main_label['sq_inch']) ? $viewDesignCard->main_label['sq_inch'] : '-' }}</td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="col">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Tab Label</th>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->tab_label['design_no']) ? $viewDesignCard->tab_label['design_no'] : '-' }}</td>
                                                    </tr>
                                                    
                                                    <tr class="main_label_input">
                                                        <td width="200px">
                                                          
                                                          {{ $viewDesignCard && isset($viewDesignCard->tab_label['quality']) ? \App\Models\WovenQuality::find($viewDesignCard->tab_label['quality'])->quality : '-' }}
                                                         </td>
                                                    </tr>
                                                    
                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->tab_label['picks']) ? $viewDesignCard->tab_label['picks'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->tab_label['total_picks']) ? $viewDesignCard->tab_label['total_picks'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->tab_label['total_repeat'][0]) ? $viewDesignCard->tab_label['total_repeat'][0].',' : '' }} {{ $viewDesignCard && isset($viewDesignCard->tab_label['total_repeat'][1]) ? $viewDesignCard->tab_label['total_repeat'][1].',' : '' }} {{ $viewDesignCard && isset($viewDesignCard->tab_label['total_repeat'][1]) ? $viewDesignCard->tab_label['total_repeat'][1] : '' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">
                                                            @if(isset($viewDesignCard->tab_label['total_labour_hours']))
                                                                @foreach($viewDesignCard->tab_label['total_labour_hours'] as $total_labour_hours)
                                                                   @if(!empty($total_labour_hours) || $total_labour_hours != null || $total_labour_hours != "")
                                                                        {{ $loop->first ? '' : ', ' }}
                                                                        {{ $total_labour_hours }}
                                                                    @else
                                                                        
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->tab_label['wastage']) ? $viewDesignCard->tab_label['wastage'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->tab_label['width']) ? $viewDesignCard->tab_label['width'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->tab_label['length']) ? $viewDesignCard->tab_label['length'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->tab_label['sq_mm']) ? $viewDesignCard->tab_label['sq_mm'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->tab_label['sq_inch']) ? $viewDesignCard->tab_label['sq_inch'] : '-' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Size Label</th>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->size_label['design_no']) ? $viewDesignCard->size_label['design_no'] : '-' }}</td>
                                                    </tr>
                                                    
                                                    <tr class="main_label_input">
                                                        <td width="200px">
                                                          {{ $viewDesignCard && isset($viewDesignCard->size_label['quality']) ? \App\Models\WovenQuality::find($viewDesignCard->size_label['quality'])->quality : '-' }}
                                                         
                                                          </td>
                                                    </tr>
                                                    
                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->size_label['picks']) ? $viewDesignCard->size_label['picks'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->size_label['total_picks']) ? $viewDesignCard->size_label['total_picks'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->size_label['total_repeat'][0]) ? $viewDesignCard->size_label['total_repeat'][0].',' : '' }} {{ $viewDesignCard && isset($viewDesignCard->size_label['total_repeat'][1]) ? $viewDesignCard->size_label['total_repeat'][1].',' : '' }} {{ $viewDesignCard && isset($viewDesignCard->size_label['total_repeat'][1]) ? $viewDesignCard->size_label['total_repeat'][1] : '' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">
                                                            @if(isset($viewDesignCard->size_label['total_labour_hours']))
                                                                @foreach($viewDesignCard->size_label['total_labour_hours'] as $total_labour_hours)
                                                                   @if(!empty($total_labour_hours) || $total_labour_hours != null || $total_labour_hours != "")
                                                                        {{ $loop->first ? '' : ', ' }}
                                                                        {{ $total_labour_hours }}
                                                                    @else
                                                                        
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->size_label['wastage']) ? $viewDesignCard->size_label['wastage'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->size_label['width']) ? $viewDesignCard->size_label['width'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->size_label['length']) ? $viewDesignCard->size_label['length'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->size_label['sq_mm']) ? $viewDesignCard->size_label['sq_mm'] : '-' }}</td>
                                                    </tr>

                                                    <tr class="main_label_input">
                                                        <td width="200px">{{ $viewDesignCard && isset($viewDesignCard->size_label['sq_inch']) ? $viewDesignCard->size_label['sq_inch'] : '-' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    
                                        <table class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Add on</th>
                                                    <th>Basic</th>
                                                    <th>Cut fold</th>	
                                                    <th>Diecut</th>	
                                                    <th>Nonwoven</th>		
                                                    <th>Iron on back</th>
                                                    <th>Extras</th>
                                                    <th>Offered</th>
                                                    <th>TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>Main</th>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_main_cost['basic']) ? $viewDesignCard->add_on_main_cost['basic'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_main_cost['cut_fold']) ? $viewDesignCard->add_on_main_cost['cut_fold'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_main_cost['diecut']) ? $viewDesignCard->add_on_main_cost['diecut'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_main_cost['nonwoven']) ? $viewDesignCard->add_on_main_cost['nonwoven'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_main_cost['iron_on_back']) ? $viewDesignCard->add_on_main_cost['iron_on_back'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_main_cost['extra']) ? $viewDesignCard->add_on_main_cost['extra'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_main_cost['total']) ? $viewDesignCard->add_on_main_cost['total'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_main_cost['offered']) ? $viewDesignCard->add_on_main_cost['offered'] : '0' }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Tab</th>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_tab_cost['basic']) ? $viewDesignCard->add_on_tab_cost['basic'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_tab_cost['cut_fold']) ? $viewDesignCard->add_on_tab_cost['cut_fold'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_tab_cost['diecut']) ? $viewDesignCard->add_on_tab_cost['diecut'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_tab_cost['nonwoven']) ? $viewDesignCard->add_on_tab_cost['nonwoven'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_tab_cost['iron_on_back']) ? $viewDesignCard->add_on_tab_cost['iron_on_back'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_tab_cost['extra']) ? $viewDesignCard->add_on_tab_cost['extra'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_tab_cost['total']) ? $viewDesignCard->add_on_tab_cost['total'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_tab_cost['offered']) ? $viewDesignCard->add_on_tab_cost['offered'] : '0' }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Size</th>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_size_cost['basic']) ? $viewDesignCard->add_on_size_cost['basic'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_size_cost['cut_fold']) ? $viewDesignCard->add_on_size_cost['cut_fold'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_size_cost['diecut']) ? $viewDesignCard->add_on_size_cost['diecut'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_size_cost['nonwoven']) ? $viewDesignCard->add_on_size_cost['nonwoven'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_size_cost['iron_on_back']) ? $viewDesignCard->add_on_size_cost['iron_on_back'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_size_cost['extra']) ? $viewDesignCard->add_on_size_cost['extra'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_size_cost['total']) ? $viewDesignCard->add_on_size_cost['total'] : '0' }}</td>
                                                    <td>{{ $viewDesignCard && isset($viewDesignCard->add_on_size_cost['offered']) ? $viewDesignCard->add_on_size_cost['offered'] : '0' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <h5 class="font-weight-bold">Main</h5>
                                        <table class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Needle No</th>
                                                    <th>Pantone</th>
                                                    <th>Color</th>
                                                    <th>Shade</th>
                                                    <th>Denier</th>
                                                    <th>A</th>
                                                    <th>B</th>
                                                    <th>C</th>
                                                    <th>D</th>
                                                    <th>E</th>
                                                </tr>
                                            </thead>
                                            <tbody id="add_new_row">
                                                @forelse($viewDesignCard->main_needle as $mainNeedle)
                                                    <tr id="inputFormRow">
                                                        <td>{{ $mainNeedle['needle_no'] ?? '-' }}</td>
                                                        <td>{{ $mainNeedle['pantone'] ?? '-' }}</td>
                                                        <td style="background:{{ $mainNeedle['color'] ?? '' }};"></td>
                                                        <td>{{ $mainNeedle['color_shade'] ?? '-' }}</td>
                                                        <td>{{ $mainNeedle['denier'] ?? '-' }}</td>
                                                        <td>{{ $mainNeedle['a1'] ?? '-' }}</td>
                                                        <td>{{ $mainNeedle['b1'] ?? '-' }}</td>
                                                        <td>{{ $mainNeedle['c1'] ?? '-' }}</td>
                                                        <td>{{ $mainNeedle['d1'] ?? '-' }}</td>
                                                        <td>{{ $mainNeedle['e1'] ?? '-' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <h5 class="font-weight-bold">Tab</h5>
                                        <table class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Needle No</th>
                                                    <th>Pantone</th>
                                                    <th>Color</th>
                                                    <th>Shade</th>
                                                    <th>Denier</th>
                                                    <th>A</th>
                                                    <th>B</th>
                                                    <th>C</th>
                                                    <th>D</th>
                                                    <th>E</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($viewDesignCard->tab_needle as $tabNeedle)
                                                    <tr>
                                                        <td>{{ $tabNeedle['needle_no'] ?? '-' }}</td>
                                                        <td>{{ $tabNeedle['pantone'] ?? '-' }}</td>
                                                        <td style="background:{{ $tabNeedle['color'] ?? '' }};"></td>
                                                        <td>{{ $tabNeedle['color_shade'] ?? '-' }}</td>
                                                        <td>{{ $tabNeedle['denier'] ?? '-' }}</td>
                                                        <td>{{ $tabNeedle['a1'] ?? '-' }}</td>
                                                        <td>{{ $tabNeedle['b1'] ?? '-' }}</td>
                                                        <td>{{ $tabNeedle['c1'] ?? '-' }}</td>
                                                        <td>{{ $tabNeedle['d1'] ?? '-' }}</td>
                                                        <td>{{ $tabNeedle['e1'] ?? '-' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <h5 class="font-weight-bold">Size</h5>
                                        <table class="table table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Needle No</th>
                                                    <th>Pantone</th>
                                                    <th>Color</th>
                                                    <th>Shade</th>
                                                    <th>Denier</th>
                                                    <th>A</th>
                                                    <th>B</th>
                                                    <th>C</th>
                                                    <th>D</th>
                                                    <th>E</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($viewDesignCard->size_needle as $sizeNeedle)
                                                    <tr>
                                                        <td>{{ $sizeNeedle['needle_no'] ?? '-' }}</td>
                                                        <td>{{ $mainNeedle['pantone'] ?? '-' }}</td>
                                                        <td style="background:{{ $sizeNeedle['color'] ?? '' }};"></td>
                                                        <td>{{ $sizeNeedle['color_shade'] ?? '-' }}</td>
                                                        <td>{{ $sizeNeedle['denier'] ?? '-' }}</td>
                                                        <td>{{ $sizeNeedle['a1'] ?? '-' }}</td>
                                                        <td>{{ $sizeNeedle['b1'] ?? '-' }}</td>
                                                        <td>{{ $sizeNeedle['c1'] ?? '-' }}</td>
                                                        <td>{{ $sizeNeedle['d1'] ?? '-' }}</td>
                                                        <td>{{ $sizeNeedle['e1'] ?? '-' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
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

@extends('adminlte::page')

@section('title', 'MOUs')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('MOUs') }}</h1>
        </div>
        @if(Auth()->User()->role_id != 2) 
        <div class="col-sm-6">
            <a href="{{ route('customermou.create') }}" class="btn bg-gradient-primary float-right">Add MOU</a>
        </div>
        @endif
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                @foreach (['danger', 'warning', 'success', 'info'] as $message)
                    @if(Session::has($message))
                        <div class="alert alert-{{ $message }}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session($message) }}
                        </div>
                    @endif
                @endforeach
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">MOU's </h3>
                      <form class="float-right d-flex search-form">
                          <button class="btn btn-sm btn-info" type="submit"  >
                            <span class=" d-flex">
                               <i class="fa fa-filter" aria-hidden="true"></i>Filter</span>
                          </button>
                          
                          <input class="form-control" type="text" name="search" placeholder="search">
                      </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-sm action-hide">
                            <thead>
                            <tr>
                                <th style="width: 100px">S.No</th>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>From</th>
                                <th>To On</th>
                                <th>Download</th>
                                <th>Upload</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i = ($mous->currentpage()-1)* $mous->perpage() + 1; @endphp
                                @forelse ($mous as $mou)
                                    <tr style="cursor: pointer;">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $mou->mou_code }}</td>
                                        <td>{{ $mou->mouDetails->full_name }}</td>
                                        <td>{{ $mou->from_date }}</td>
                                        <td>{{$mou->to_date}}</td>
                                        <td> 
                                            <form method="POST" enctype="multipart/form-data"  action="{{ route('customermou.downloadPdf', $mou->id) }}"
                                                accept-charset="UTF-8"
                                                style="display: inline-block;"
                                                >
                                                @method('PUT')
                                                @csrf
                                            <input type="submit" class="btn bg-gradient-warning mr-2" value="{{ __('Download') }}"">
                                            </form>
                                        </td>
                                        <td>
                                            <!-- Trigger the modal with a button -->
                                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">Upload</button>

                                            <!-- Modal -->
                                            <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Upload Document</h4>
                                                </div>
                                                <form method="POST" enctype="multipart/form-data"  action="{{ route('customermou.upload', $mou->id) }}"
                                                    accept-charset="UTF-8"
                                                    style="display: inline-block;"
                                                    >
                                                    @method('PUT')
                                                    @csrf
                                                <div class="modal-body">                                                     
                                                      <input type="file" name="mou_upload" >
                                                 
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                                </form>
                                                </div>

                                            </div>
                                            </div>                                                                  
                                            
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('customermou.show',$mou->id) }}" class="btn btn-sm btn-warning">View</a>
                                            <a href="{{ route('incentive.details',$mou->id) }}" class="btn btn-sm btn-success">View Incentive</a>
                                        </td>
                                        <td></td>
                                    </tr>
                                 @empty
                                    <tr>
                                        <th colspan="7" class="text-center">No Data Found...</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {!! $mous->links() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            </div>
        </div>
    </section>
@stop

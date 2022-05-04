@extends('adminlte::page')

@section('title', 'Create loom')

@section('content_header')
    <div class="row mb-0">
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="offset-md-1">

                    @foreach (['danger', 'warning', 'success', 'info'] as $message)
                        @if(Session::has($message))
                            <div class="alert alert-{{ $message }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session($message) }}
                            </div>
                    @endif
                @endforeach

                <!-- general form elements -->
                    <div class="card card-primary" style="width: 850px;" >
                        <div class="card-header">
                            <h3 class="card-title">Create Loom</h3>
                            <div class="float-right">
                                <a href="{{ route('looms.index') }}" class="btn bg-gradient-primary float-right">Cancel</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('looms.store') }}" novalidate>
                            @csrf
                            <div class="card-body row">

                               
                                <div class="form-group col-6">
                                    <label for="loom_name">Loom Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('loom_name') is-invalid @enderror" id="loom_name" name="loom_name" value="{{old('loom_name')}}" placeholder="Loom Name">
                                    @error('loom_name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="weaving_width_Meter">Weaving (mm) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('weaving_width_Meter') is-invalid @enderror" id="weaving_width_Meter" name="weaving_width_Meter" value="{{old('weaving_width_Meter')}}" placeholder="Weaving width Meter">
                                    @error('weaving_width_Meter')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="sections">Sections <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('sections') is-invalid @enderror" id="sections" name="sections" value="{{old('sections')}}" placeholder="Sections">
                                    @error('sections')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="speed">Speed (rpm) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('speed') is-invalid @enderror" id="speed" name="speed" value="{{old('speed')}}" placeholder="speed">
                                    @error('speed')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="year">Year <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{old('year')}}" placeholder="Year">
                                    @error('year')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" value="{{old('notes')}}"></textarea>
                                    
                                    @error('notes')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                               
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
@stop

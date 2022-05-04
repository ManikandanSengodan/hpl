@extends('adminlte::page')

@if($editink)
    @section('title', 'Edit Raw Material')
@else
    @section('title', 'Create Raw Material')
@endif

@section('content_header')
    <div class="row justify-content-center mb-1">
        <div class="col-md-8">
            <h1 class="float-left ml-2 font-weight-bold">
                @if($editink)
                {{ __('Edit Raw Material - ') . ucfirst($editink->supplier)}}
                @else
                {{ __('Create Raw Material') }}
                @endif
            </h1>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @foreach (['danger', 'warning', 'success', 'info'] as $message)
                        @if(Session::has($message))
                            <div class="alert alert-{{ $message }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session($message) }}
                            </div>
                        @endif
                    @endforeach

                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $editink ? 'Edit Ink' : 'Create Ink ' }}</h3>
                            <div class="float-right">
                                @if($editink)
                                    <button class="btn bg-gradient-primary btn-md mr-2" onclick="submitForm()">Update</button>
                                    <a href="{{ route('ink.show',$editink->id) }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                @else
                                <a href="{{ route('ink.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <form method="POST" id="submit_form" action="{{ $editink ? route('ink.update', $editink->id) : route('ink.store')  }}" novalidate>
                                @csrf
                                @if($editink) @method('PUT') @endif
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="color">ink Color <span class="text-danger">*</span></label><!-- #ff0000 -->
                                        <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ $editink ? old('color',$editink->color) : old('color') }}" placeholder="ink Color">
                                        @error('color')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                
                                    <div class="form-group col-6">
                                        <label for="shade_no">Shade No <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('shade_no') is-invalid @enderror" id="shade_no" name="shade_no" value="{{ $editink ? old('shade_no',$editink->shade_no) : old('shade_no') }}" placeholder="Shade No">
                                        @error('shade_no')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="make">Make <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('make') is-invalid @enderror" id="make" name="make">{{ $editink ? old('make',$editink->make) : old('make') }}</textarea>
                                        @error('make')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary btn-md mr-2 float-right">{{ $editink ? 'Update' : 'Save'}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <script>
        function submitForm() {
            $('#submit_form').submit();
        }
    </script>
@stop

@extends('adminlte::page')

@section('title', 'Edit yarn')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Edit yarn - ') . $yarn->supplier }}</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('yarns.index') }}" class="btn bg-gradient-primary float-right">Back</a>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
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
                    <div class="card card-primary" style="width: 850px;">
                        <div class="card-header">
                            <h3 class="card-title">Edit yarn</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('yarns.update', $yarn->id) }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-body row">

                           
                            <div class="form-group col-6">
                                    <label for="supplier">supplier Name</label>
                                    <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier" value="{{$yarn->supplier}}" placeholder="Supplier Name">
                                    @error('supplier')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="yarn_denier">Yarn Denier</label>
                                    <input type="text" class="form-control @error('yarn_denier') is-invalid @enderror" id="yarn_denier" name="yarn_denier" value="{{$yarn->yarn_denier}}" placeholder="Yarn Denier">
                                    @error('yarn_denier')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="shade_No">Shade No</label>
                                    <input type="text" class="form-control @error('shade_No') is-invalid @enderror" id="shade_No" name="shade_No" value="{{$yarn->shade_No}}" placeholder="Shade No">
                                    @error('shade_No')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="shade_No_suffix"></label>
                                    <input type="text" class="form-control @error('shade_No_suffix') is-invalid @enderror" id="shade_No_suffix" name="shade_No_suffix" value="{{$yarn->shade_No_suffix}}" placeholder="Shade No">
                                    @error('shade_No_suffix')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="yarn_color">Yarn Color</label>
                                    <input type="color" class="form-control @error('yarn_color') is-invalid @enderror" id="yarn_color" name="yarn_color" value="{{$yarn->yarn_color}}" placeholder="Yarn Color">
                                    @error('yarn_color')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                                <div class="form-group col-6">
                                    <label for="color_shade">Color Shade</label>
                                    <input type="text" class="form-control @error('color_shade') is-invalid @enderror" id="color_shade" name="color_shade" value="{{$yarn->color_shade}}" placeholder="Color Shade">
                                    @error('color_shade')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" value="{{$yarn->notes}}">{{$yarn->notes}}</textarea>
                                    
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

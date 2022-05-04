@extends('adminlte::page')

@section('title', 'Create Weaving quality')

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
                    <div class="card card-primary" style="width: 850px;">
                        <div class="card-header">
                            <h3 class="card-title">Create Weaving Quality</h3>
                            <div class="float-right">
                                <a href="{{ route('wovenqualitys.index') }}" class="btn bg-gradient-primary float-right">Cancel</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('wovenqualitys.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="card-body row justify-content-center">

                               <div class="col-md-6" style=""> 
                                <div class="form-group">
                                    <label for="quality">Quality <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('quality') is-invalid @enderror" id="quality" name="quality" value="{{old('quality')}}" placeholder="Quality">
                                    @error('quality')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                   <div class="form-group">
                                       <label for="image">Image <span class="text-danger">*</span></label>
                                       <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
                                       @error('image')
                                       <span class="error invalid-feedback">{{ $message }}</span>
                                       @enderror
                                   </div>
                                <div class="form-group">
                                    <label for="material">Material <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('material') is-invalid @enderror" id="material" name="material" value="{{old('material')}}" placeholder="Material">
                                    @error('material')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" value="{{old('notes')}}"></textarea>
                                    
                                    @error('notes')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
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

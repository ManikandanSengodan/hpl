@extends('adminlte::page')

@section('title', 'Edit fold')

@section('content_header')
    <div class="row mb-0">
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
                            <h3 class="card-title">Edit Fold</h3>
                            <div class="float-right">
                                <button type="submit" onclick="submitForm()" class="btn bg-gradient-primary btn-md mr-2">Update</button>
                                <a href="{{ route('printed-folds.show', $fold->id) }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" id="submit_form" action="{{ route('printed-folds.update', $fold->id) }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-body row justify-content-center">

                            <div class="col-md-6" style=""> 
                            <div class="form-group">
                                    <label for="type_of_fold">Type of Fold <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('type_of_fold') is-invalid @enderror" id="type_of_fold" name="type_of_fold" value="{{$fold->type_of_fold}}" placeholder="Type of Fold">
                                    @error('type_of_fold')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ $fold->image }}">
                                    @error('image')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="minimum_mm">Minimum mm <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('minimum_mm') is-invalid @enderror" id="minimum_mm" name="minimum_mm" value="{{$fold->minimum_mm}}" placeholder="Minimum mm">
                                    @error('minimum_mm')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="maximum_mm">Maximum mm <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('maximum_mm') is-invalid @enderror" id="maximum_mm" name="maximum_mm" value="{{$fold->maximum_mm}}" placeholder="Maximum mm">
                                    @error('maximum_mm')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" value="{{$fold->notes}}">{{$fold->notes}}</textarea>
                                    
                                    @error('notes')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
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

    <script>
        function submitForm() {
            $('#submit_form').submit();
        }
    </script>
@stop

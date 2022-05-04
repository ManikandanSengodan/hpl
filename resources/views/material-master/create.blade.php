@extends('adminlte::page')

@if($editMaterial)
    @section('title', 'Edit Raw Material')
@else
    @section('title', 'Create Raw Material')
@endif

@section('content_header')
    <div class="row justify-content-center mb-0">
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
                            <h3 class="card-title"> {{ $editMaterial ? 'Edit Material' : 'Create Material ' }}</h3>
                            <div class="float-right">
                                @if($editMaterial)
                                    <button class="btn bg-gradient-primary btn-md mr-2" onclick="submitForm()">Update</button>
                                    <a href="{{ route('material-master.show',$editMaterial->id) }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                @else
                                <a href="{{ route('material-master.index') }}" class="btn bg-gradient-primary btn-md mr-2">{{ __('Cancel') }}</a>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <form method="POST" id="submit_form" action="{{ $editMaterial ? route('material-master.update', $editMaterial->id) : route('material-master.store')  }}" novalidate>
                                @csrf
                                @if($editMaterial) @method('PUT') @endif
                                
                                    
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="make">Name <span class="text-danger">*</span></label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value=
                                        "{{ $editMaterial ? old('make',$editMaterial->name) : old('name') }}" />
                                        @error('name')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn bg-gradient-primary btn-md mr-2 float-right">{{ $editMaterial ? 'Update' : 'Save'}}</button>
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

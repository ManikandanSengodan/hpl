@extends('adminlte::page')

@section('title', 'Create Warp')

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
                    <div class="card card-primary" style="width: 850px;" >
                        <div class="card-header">
                            <h3 class="card-title">Create Warp</h3>
                            <div class="col-sm-6 float-right">
                                <a href="{{ route('warps.index') }}" class="btn bg-gradient-primary float-right">Cancel</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('warps.store') }}" novalidate>
                            @csrf
                            <div class="card-body row justify-content-center">

                               <div class="col-md-6">

                               <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Name">
                                    @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                                <div class="form-group">
                                    <label for="colour">Colour <span class="text-danger">*</span></label>
                                    <input type="color" class="form-control @error('colour') is-invalid @enderror" id="colour" name="colour" value="#ff0000" placeholder="colour">
                                    @error('colour')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                   <div class="form-group">
                                       <label for="notes">Notes</label>
                                       <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes">{{ old('notes') }}</textarea>
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
